<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\member;
use App\Models\Message;
use App\Models\OtpCode;
use App\Models\PatientSession;
use App\Models\Pattient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PatientSessionController extends Controller
{
    public function index()
    {
        // return 1;
        $data = [
            'patient_sessions' => Auth::user()->active_sessions,
            'branch_name' => Auth::user()->branch_name,
        ];
        return view('patient_sessions.index')->with($data);
    }


    public function create()
    {
        return view('patient_sessions.create');
    }

    public function store(Request $request)
    {

        $otp_code = $request->input('otp_code');

        $otp = OtpCode::where('otp_code', $otp_code)
            ->where('is_active', 1)
            ->select('id', 'patient_id')
            ->first();

        if (!$otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ]);
        }

        try {
            DB::beginTransaction();

            // create a session
            PatientSession::create([
                'patient_id' => $otp->patient_id,
                'branch_id' =>  Auth::user()->member->branch_id,
                'patient_otp_id' => $otp->id,
                'created_by' => Auth::id(),
                'updated_by' => null,
                'is_active' => 1
            ]);

            $otp->is_active = 0;
            $otp->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect_url' => route('pattientarea')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id, $session_id)
    {
        // return $id;
        $patient = Pattient::select('pattient_number')
            ->where('id', $id)
            ->first();

        $save_data_controller = new saveDataController();
        $patient_data = $save_data_controller->Patient_Details($patient->pattient_number);

        $data = [
            'patientData' => $patient_data,
            'messages' => Message::orderBy('id', 'desc')->get(),
            'session_id' => $session_id
        ];

        return view('pattientdetail')->with($data);
    }

    public function closeSession(Request $request)
    {
        $patient_session = PatientSession::find($request->session_id);

        $patient_session->update([
            'is_active' => 0,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('patient-sessions.index')->with('success', 'Session closed successfully');
    }
}
