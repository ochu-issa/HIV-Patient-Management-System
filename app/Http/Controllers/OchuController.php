<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}

