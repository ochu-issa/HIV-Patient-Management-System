<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\member;
use App\Models\Message;
use App\Models\PatientSession;
use App\Models\Pattient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientSessionController extends Controller
{
    public function index()
    {
        $data = [
            'patient_sessions' => Auth::user()->active_sessions,
            'branch_name' => Auth::user()->branch_name,
        ];
        return view('patient_session')->with($data);
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

        //create a session
        PatientSession::create([
            'patient_id' => $patient->id,
            'branch_id' =>  Auth::user()->member->branch_id,
            'patient_otp_id' => null,
            'created_by' => Auth::id(),
            'updated_by' => null,
            'is_active' => 1
        ]);

        if (Auth::user()->hasRole('Receptionist')) {
            return redirect()->route('pattientarea')->with('success', 'Session created successfully');
        }

        return $this->index();
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
    
        return redirect()->route('patient-sessions')->with('success', 'Session closed successfully');
    }
}
