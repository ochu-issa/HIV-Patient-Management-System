<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientSessionController extends Controller
{
    public function checkPatientExist($id)
    {
        return view('check_patient_exist');
    }
}
