<?php

namespace App\Http\Controllers;

use App\Models\OtpCode;
use App\Models\PatientSession;
use App\Models\Pattient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class OtpCodeController extends Controller
{
    public function index()
    {
        if (Gate::allows('Super-Admin')) {
            return redirect()->back()->with('error', 'You are not authorized to perfom this action!.');
        }
        
        $data = [
            'otp_codes' => OtpCode::with(['patient' => function ($query) {
                $query->select('id', 'f_name', 'l_name', 'pattient_number');
            }])
                ->orderBy('id', 'desc')
                ->get(),
        ];

        return view('otp_codes.index')->with($data);
    }

    public function create()
    {
        return view('otp_codes.create');
    }

    public function store(Request $request)
    {
        $patient = Pattient::find($request->patient_id);

        $patient_session = PatientSession::where('patient_id', $patient->id)
            ->where('is_active', 1)
            ->first();

        if ($patient_session) {
            return redirect()->back()->with('alert-info', 'There is still active session for this patient. Please close it and start new session.');
        }

        try {
            $full_name = $patient->full_name;
            $otp_code = rand(100000, 999999);
            $phone_number = $patient->phone_number;

            // store OTP 
            OtpCode::create([
                'patient_id' => $patient->id,
                'created_by' => Auth::id(),
                'otp_code' => $otp_code,
                'is_active' => 1
            ]);

            // send OTP message 
            $this->sendOtpCode($full_name,  $phone_number, $otp_code,);

            if (Gate::allows('Receptionist')) {
                return redirect()->route('pattientarea')->with('success', 'Session created successfully');
            }

            DB::commit();
            return redirect()->route('patient-sessions.create');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function sendOtpCode($full_name, $phone_number, $otp_code)
    {
        $api_key = "024cffc7c9271bf3";
        $secret_key = "YTVmYzkzYzlkNDY4ZTE5MjEzMjhlMDc0YjA1ZmE1NGQyYmM5MjM2MWZiMGU3NDAyOTk4ZGFhYmFkMzliZDRkNA==";

        $message = sprintf(
            'Ndugu %s, %s ni namba ya uthibitisho kwa ajili ya kuruhusu taarifa zako za HIV AIDs kuonekanwa.',
            $full_name,
            $otp_code
        );

        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => [
                array('recipient_id' => '1', 'dest_addr' => $phone_number)
            ]
        );

        $Url = "https://apisms.beem.africa/v1/send";

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            $error = curl_error($ch);
            Log::error('CURL error: ' . $error);
            return response("Error: " . $error);
        } else {
            $decodedResponse = json_decode($response, true);

            if ($decodedResponse === null && json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON decode error: ' . json_last_error_msg());
                return response('Error: Invalid JSON response');
            }

            if (isset($decodedResponse['status']) && $decodedResponse['status'] == '01') {
                Log::info('Message sent successfully');
                return response("Message sent successfully.");
            } else {
                Log::error('Error sending message: ' . json_encode($postData) . ' Response: ' . $response);
                return response("Error sending message: " . $response);
            }
        }
    }
}
