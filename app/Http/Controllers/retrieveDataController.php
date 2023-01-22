<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchAdmin;
use App\Models\Receptionist;
use App\Models\Doctor;
use App\Models\member;
use App\Models\Pattient;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//use DB;

class retrieveDataController extends Controller
{
    //retrieve branch data
    public function retrieveData()
    {
        $branches = Branch::where('branch_name', '!=' ,'Ministry of Health')->get();
        $no = 0;
        $no++;
        return view('branches', ['branches' => $branches, 'no' => $no]);
    }

    //retrieve branch admin data
    public function ShowBranchAdminData()
    {
        $branchAdmins = member::role('Branch-Admin')->get();
        $no = 1;
        $branches = Branch::where('branch_name', '!=' ,'Ministry of Health')->get();

        return view('branchadmin', ['branchAdmins'=>$branchAdmins, 'no'=>$no, 'branches'=>$branches]);
    }

    //retrieve Receptionist
    public function ShowReceptionistData()
    {
        $receptionist = member::role('Receptionist')->get();
        $no=1;
        $branches = Branch::where('branch_name', '!=' ,'Ministry of Health')->get();

        return view('receptionist', ['receptionists'=>$receptionist, 'no'=>$no, 'branches'=>$branches]);
    }

    //retrieve Doctors
    public function ShowDoctorsData()
    {
        $doctors = member::role('Doctor')->get();
        $no = 1;
        $branches = Branch::where('branch_name', '!=' ,'Ministry of Health')->get();

        return view('doctor', ['doctors' => $doctors, 'no' => $no, 'branches' => $branches]);

    }

    //retrieve pattients
    public function ShowPattientData()
    {
        $pattients = Pattient::get();
        $no = 1;
        $branches = Branch::get();

        return view('pattient', ['pattients' => $pattients, 'no' => $no, 'branches' => $branches]);

    }

    //Role and permission
    public function RolePermission()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('roleandpermission', ['permissions' => $permissions, 'roles' => $roles]);
    }
}
