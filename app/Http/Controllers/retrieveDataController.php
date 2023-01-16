<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchAdmin;
use App\Models\Receptionist;
use App\Models\Doctor;
use App\Models\Roles;
use App\Models\Permissions;

//use DB;

class retrieveDataController extends Controller
{
    //retrieve branch data
    public function retrieveData()
    {
        $branches = Branch::get();
        $no = 0;
        $no++;
       //$branches = Branch::table('branches')->get();
        return view('branches', ['branches' => $branches, 'no' => $no]);
    }

    //retrieve branch admin data
    public function ShowBranchAdminData()
    {
        $branchAdmins = BranchAdmin::get();
        $no = 1;
        $branches = Branch::get();

        return view('branchadmin', ['branchAdmins'=>$branchAdmins, 'no'=>$no, 'branches'=>$branches]);
    }

    //retrieve Receptionist
    public function ShowReceptionistData()
    {
        $receptionist = Receptionist::get();
        $no=1;
        $branches = Branch::get();

        return view('receptionist', ['receptionists'=>$receptionist, 'no'=>$no, 'branches'=>$branches]);
    }

    //retrieve Doctors
    public function ShowDoctorsData()
    {
        $doctors = Doctor::get();
        $no = 1;
        $branches = Branch::get();

        return view('doctor', ['doctors' => $doctors, 'no' => $no, 'branches' => $branches]);

    }

    //Role and permission
    public function RolePermission()
    {
        // $roles = Roles::get();
        // $permissions = Permissions::get();
        return view('roleandpermission');
    }
}
