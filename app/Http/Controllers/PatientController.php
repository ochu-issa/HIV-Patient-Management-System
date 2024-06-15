<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Pattient;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|unique:pattients',
            //'pattient_number' => 'required|numeric|unique:receptionists',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages());
        }

        try {
            DB::beginTransaction();
            $month = date('m');
            $date = date('d');

            $pattient_number = mt_rand(1000, 9999);

            $pattient_number = 'MM/' . $month + $date . '/' . $pattient_number;

            $check_pattient_number = Pattient::where('pattient_number', $pattient_number)->first();

            while ($check_pattient_number) {
                $pattient_number = mt_rand(1000, 9999);
                $pattient_number = 'MM/' . $month + $date . '/' . $pattient_number;
                $check_pattient_number = Pattient::where('pattient_number', $pattient_number)->first();
            }

            $id = Auth::user()->member_id;
            $user_branch_id = member::where('id', $id)->first()->branch_id;

            $highest_member_id = member::max('id');
            $new_pattient_id = $highest_member_id + 1;

            $pattient = Pattient::create([
                'id' => $new_pattient_id,
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'pattient_number' => $pattient_number,
                'branch_id' => $user_branch_id,
                'status' => 1,
            ]);

            $randon_password = Str::random(12);
            $user = User::create([
                'member_id' => $pattient->id,
                'role_id' => null,
                'username' => $pattient_number,
                'password' => Hash::make('password')
            ]);

            $full_name = $request->f_name . ' ' . $request->l_name;
            $phone_number = $request->phone_number;
            $this->sendSms($full_name, $phone_number, $user->username, $user->password);
            DB::commit();

            return redirect()->back()->with('success', 'Pattient Addedd successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function sendSms($full_name, $phone_number, $username, $password)
    {
        $formatted_date = Carbon::now()->format('d/m/Y h:iA');
        $api_key = env('BEEM_API_KEY');
        $secret_key = env('BEEM_SECRET_KEY');

        $message = sprintf(
            'Ndugu %s, Akaunti yako imetengenezwa kikamilifu %s. Username: %s, Password: %s. Tafadhali tumia taarifa hizi kwa kuingia kwenye account yako kwenye App yetu. Asante.',
            $full_name,
            $formatted_date,
            $username,
            $password
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

        $Url = env('BEEM_URL');

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
            return response("Error: " . $error);
        } else {
            $decodedResponse = json_decode($response, true);

            if ($decodedResponse && isset($decodedResponse['status']) && $decodedResponse['status'] == '01') {
                Log::info('Message sent successfully');
                return response("Message sent successfully.");
            } else {
                Log::error('Error sending message: ' . $response);
                return response("Error sending message: " . $response);
            }
        }
    }
}
