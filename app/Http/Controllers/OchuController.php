<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Branch;

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

    public function testing()
    {
        return view('testing-modal');
    }

    public function responseCheck($id)
    {
        $branch = Branch::where('id', $id)->first();
        //dd($branch);
        return response()->json([
            "name" => $branch->branch_name,
            "status" => $branch->status,
            "id" => $branch->id,
        ]);
    }

}

