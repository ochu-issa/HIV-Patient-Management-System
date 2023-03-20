<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchAdmin;
use App\Models\Receptionist;
use App\Models\Doctor;
use App\Models\member;
use App\Models\User;
use App\Models\Pattient;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//use DB;


class retrieveDataController extends Controller
{
    //retrieve branch data
    public function retrieveData()
    {
        /**  @var \App\Models\MyUserModel $user **/

        $user = auth()->user();

        if (!$user->hasAnyPermission(['View-Branch'])) {
            return redirect()->back()->with(['error' => 'You are not authorized to perform this action.']);
        } else {
            $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->orderByDesc('id')->get();
            $no = 0;
            $no++;
            return view('branches', ['branches' => $branches, 'no' => $no]);
        }
    }

    //retrieve branch admin data
    public function ShowBranchAdminData()
    {
        $branchAdmins = member::role('Branch-Admin')->get();
        $no = 1;
        $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->orderByDesc('id')->get();

        return view('branchadmin', ['branchAdmins' => $branchAdmins, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve Receptionist
    public function ShowReceptionistData()
    {
        $receptionist = member::role('Receptionist')->get();
        $no = 1;
        $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->orderByDesc('id')->get();

        return view('receptionist', ['receptionists' => $receptionist, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve Doctors
    public function ShowDoctorsData()
    {
        $doctors = member::role('Doctor')->get();
        $no = 1;
        $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->orderByDesc('id')->get();

        return view('doctor', ['doctors' => $doctors, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve pattients
    public function ShowPattientData()
    {
        $pattients = Pattient::orderByDesc('id')->get();;
        $no = 1;
        $branches = Branch::all();

        return view('pattient', ['pattients' => $pattients, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve Pattient Details
    public function PattientDetails()
    {
        return view('pattientdetail');
    }

    //Role and permission
    public function RolePermission()
    {

        $roles = Role::get();
        $permissions = Permission::get();
        return view('roleandpermission', ['permissions' => $permissions, 'roles' => $roles]);
    }

    //Patient Details
    public function PatientDetails($PatientNumber)
    {
        $patientData = Pattient::where('pattient_number', $PatientNumber)->first();
        return $patientData;
    }

    //retrieve information
    public function RetrievePatientInformation($Patient_Number)
    {
        $patient_data = $this->PatientDetails($Patient_Number);
        if ($patient_data) {
            return view('pattientdetail', ['data' => $patient_data]);
        } else {
            return redirect()->back()->with('error', 'Error: Patient with number '.$patient_data.' does not exist!');
        }
    }
}
