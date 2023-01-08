<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

//use DB;

class retrieveDataController extends Controller
{
    //retrieve branch data
    public function retrieveData(){
        $branches = Branch::get();
        $no = 0;
        $no++;
       //$branches = Branch::table('branches')->get();
        return view('branches', ['branches' => $branches, 'no' => $no]);
    }
}
