<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class OchuController extends Controller
{
    public function Test()
    {
        return view('home');
    }

    //Pattient Controller
    public function PattientArea()
    {
        return view('PattientArea');
    }

    //Manage Pattient Controller
    public function Pattient()
    {
        return view('Pattient');
    }

    //Manage branches Controller
    public function Branch()
    {
        return view('branches');
    }

    //Manage doctor Controller
    public function Doctor()
    {
        return view('doctor');
    }

    //Manage Receptionist Controller
    public function Receptionist()
    {
        return view('receptionist');
    }

    //Manage Branchadmin Controller
    public function Branchadmin()
    {
        return view('branchadmin');
    }

    // public function saveDoctor(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|unique:doctors|max:255',
    //         'fname' => 'required',
    //     ]);

    //     $doctor_id = Doctor::create([
    //         'f_name' => $request->f_name,
    //         //
    //     ])->id;
            // other way....
        // $doctor = new Doctor;
        // $doctor->f_name = $request->f_name;
        // $doctor->save();

    //     $user = User::create([
    //         'doctor_id' => $doctor_id
    //     ]);
    // }

}

