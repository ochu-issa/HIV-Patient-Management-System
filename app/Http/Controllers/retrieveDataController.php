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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
//use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


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
        if (!Auth::user()->hasRole('Super-Admin')) {
            return redirect()->back()->with(['error' => 'You are not authorized to perform this action.']);
        }

        $all_user_branchadmin = User::role('Branch-Admin')->pluck('member_id');
        $branchAdmins = member::whereIn('id', $all_user_branchadmin)->orderBy('id', 'desc')->get();
        $no = 1;
        $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->orderByDesc('id')->get();

        return view('branchadmin', ['branchAdmins' => $branchAdmins, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve Receptionist
    public function ShowReceptionistData()
    {
        $auth_user = auth()->user()->member_id;
        $auth_user_branch_id = member::where('id', $auth_user)->first()->branch_id;

        if (auth()->user()->hasRole(Role::findByName('Branch-Admin'))) {

            // Get the IDs of all receptionists in the same branch as the authenticated user
            $all_user_receptionist = User::role('Receptionist')
                ->join('members', 'users.member_id', '=', 'members.id')
                ->where('members.branch_id', $auth_user_branch_id)
                ->pluck('users.member_id');

            // Retrieve the member records for the selected receptionists
            $receptionists = Member::whereIn('id', $all_user_receptionist)
                ->orderBy('id', 'desc')
                ->get();

            $branches = Branch::where('id', $auth_user_branch_id)->get();
        } elseif (auth()->user()->hasRole(Role::findByName('Super-Admin'))) {
            $all_user_receptionist = User::role('Receptionist')->pluck('member_id');
            $receptionists = Member::whereIn('id', $all_user_receptionist)->orderBy('id', 'desc')->get();
            $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->get();
        } else {
            return redirect()->back()->with(['error' => 'You are not authorized to perform this action.']);
        }

        $no = 1;
        return view('receptionist', ['receptionists' => $receptionists, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve Doctors
    public function ShowDoctorsData()
    {
        $auth_user = Auth::user()->member_id;
        $auth_user_branch_id = member::where('id', $auth_user)->first()->branch_id;

        if (auth()->user()->hasRole(Role::findByName('Branch-Admin'))) {

            // Get the IDs of all doctors in the same branch as the authenticated user
            $all_user_doctor = User::role('Doctor')
                ->join('members', 'users.member_id', '=', 'members.id')
                ->where('members.branch_id', $auth_user_branch_id)
                ->pluck('users.member_id');

            // Retrieve the member records for the selected doctors
            $doctors = Member::whereIn('id', $all_user_doctor)
                ->orderBy('id', 'desc')
                ->get();

            $branches = Branch::where('id', $auth_user_branch_id)->get();
        } elseif (Auth::user()->hasRole(Role::findByName('Super-Admin'))) {
            $all_user_doctor = User::role('Doctor')->pluck('member_id');
            $doctors = member::whereIn('id', $all_user_doctor)->orderBy('id', 'desc')->get();
            $branches = Branch::where('branch_name', '!=', 'Ministry of Health')->get();
        } else {
            return redirect()->back()->with(['error' => 'You are not authorized to perform this action.']);
        }

        $no = 1;
        return view('doctor', ['doctors' => $doctors, 'no' => $no, 'branches' => $branches]);
    }

    //retrieve pattients
    public function ShowPattientData()
    {
        $auth_user = auth()->user()->member_id;
        $auth_user_branch_id = member::where('id', $auth_user)->first()->branch_id;

        if (Auth::user()->hasRole(Role::findByName('Super-Admin'))) {
            $pattients = Pattient::orderByDesc('id')->get();
        } elseif (Auth::user()->hasRole(Role::findByName('Branch-Admin')) || Auth::user()->hasRole(Role::findByName('Doctor'))) {
            $pattients = Pattient::where('branch_id', $auth_user_branch_id)->orderByDesc('id')->get();
        }elseif(Auth::user()->hasRole(Role::findByName('Receptionist'))){
            //$pattients = Pattient::where('branch_id', $auth_user_branch_id)->orderByDesc('id')->get();
            $pattients = Pattient::orderByDesc('id')->get();

        }
        else {
            return redirect()->back()->with(['error' => 'You are not authorized to perform this action.']);
        }
        $no = 1;
        $branches = Branch::all();

        return view('pattient', ['pattients' => $pattients, 'no' => $no, 'branches' => $branches]);
    }

    //Pattient Controller
    public function PattientArea()
    {
        if (Auth::user()->hasRole('Super-Admin') ||  Auth::user()->hasRole('Branch-Admin') || Auth::user()->hasRole('Doctor')) {
            return view('PattientArea');
        } else {
            return redirect()->back()->with(['error' => 'You are not authorized to perform this action.']);
        }
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
            return redirect()->back()->with('error', 'Error: Patient with number ' . $patient_data . ' does not exist!');
        }
    }

    //profile Details
    public function profileDetails()
    {
        $user = Member::where('id', Auth::user()->member_id)->first();

        return view('profile', ['user' => $user]);

    }

    // //UnAuthorized Access
    // public function UnAuthorizedAccess()
    // {
    //     $user = Auth()->user();
    // }
}
