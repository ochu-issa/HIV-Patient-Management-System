<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchAdmin;
use App\Models\Receptionist;
use App\Models\Doctor;
use App\Models\member;
use App\Models\Message;
use App\Models\PatientDetails;
use App\Models\Pattient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class saveDataController extends Controller
{
    //this method for branch CRUD
    public function saveData(Request $request)
    {
        //validating data
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required|string|unique:branches',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        //send data in database
        $branch = new Branch();
        $branch->branch_name = $request->input('branch_name');
        $branch->save();
        return redirect()->route('branches')->with('success', 'Branch Addedd successfully!');

        //retrieve data
        $branches = Branch::get();
        $no = 0;
        $no++;
        return view('branches', ['branches' => $branches, 'no' => $no]);
    }

    //method for deleting  branch
    public function deleteBranch($id)
    {
        $branch = Branch::find($id);

        $branch->BranchAdmin()->delete();
        $branch->Receptionist()->delete();
        $branch->Doctor()->delete();
        $branch->Pattient()->delete();
        $branch->delete();

        // Redirect to the branches page
        return redirect()->route('branches')->with('success', 'Branch deleted successfully');
    }

    //update branch record
    public function updateRecord(Request $request)
    {
        // dd('test');
        //validate the input
        $this->validate($request, [
            'branch_name' => 'required',
            'branch_id' => 'required'
        ]);

        //find the id
        $branch = Branch::find($request->branch_id);

        //save the data
        $branch->branch_name = $request->input('branch_name');
        $branch->save();

        return redirect()->route('branches')->with('success', 'Branch updated successfully!');
    }

    //update branch status
    public function updateStatus($id)
    {
        //find branch id
        $branch = Branch::find($id);

        //save new status
        $branch->status = 0;
        $branch->save();

        return redirect()->route('branches')->with('success', 'The branch now is Unactive');
    }

    //update branch status
    public function updateStatusToOne($id)
    {
        //find branch id
        $branch = Branch::find($id);

        //save new status
        $branch->status = 1;
        $branch->save();

        return redirect()->route('branches')->with('success', 'The branch now is Active');
    }

    //this is CRUD for Branch Admin
    public function AddBranchAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|email|unique:members',
            'phone_number' => 'required|numeric|unique:members',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'User is exist!');
        }

        //select from branch
        $branchName = $request->branchname;
        $branch = Branch::where('branch_name', $branchName)->first();

        //create user and take the id and assign role
        $member = member::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'branch_id' => $branch->id,
        ]);

        //select role id and insert into User table
        $role_id = Role::where('name', 'Branch-Admin')->first()->id;
        User::create([
            'member_id' => $member->id,
            'role_id' => $role_id,
            'password' => Hash::make('password'),
        ])->assignRole('Branch-Admin');

        return redirect()->route('branchadmin')->with('success', 'Branch Admin Addedd successfully!');
    }

    //this CRUD for Receptionist
    public function AddReceptionist(Request $request)
    {
        //dd('test');
        $validator = validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|email|unique:members',
            'phone_number' => 'required|numeric|unique:members',
        ]);

        //select from branch
        $branchName = $request->branchname;
        $branch = Branch::where('branch_name', $branchName)->first();

        //create user and take the id and assign role
        $member = member::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'branch_id' => $branch->id,
        ]);

        //select role id and insert into User table
        $role_id = Role::where('name', 'Receptionist')->first()->id;
        User::create([
            'member_id' => $member->id,
            'role_id' => $role_id,
            'password' => Hash::make('password'),
        ])->assignRole('Receptionist');

        return redirect()->route('receptionist')->with('success', 'Receptionist Addedd successfully!');
    }

    //this is CRUD for Doctor
    public function AddDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|email|unique:members',
            'phone_number' => 'required|numeric|unique:members',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', '[User is exist!]');
        }

        //select from branch
        $branchName = $request->branchname;
        $branch = Branch::where('branch_name', $branchName)->first();

        //create user and take the id and assign role
        $member = member::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'branch_id' => $branch->id,
        ]);

        //select role id and insert into User table
        $role_id = Role::where('name', 'Doctor')->first()->id;
        User::create([
            'member_id' => $member->id,
            'role_id' => $role_id,
            'password' => Hash::make('password'),
        ])->assignRole('Doctor');
        return redirect()->back()->with('success', 'Doctor Addedd successfully!');
    }

    //this crud for Pattient
    public function AddPattient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|unique:receptionists',
            //'pattient_number' => 'required|numeric|unique:receptionists',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        // Generate current month and date
        $month = date('m');
        $date = date('d');

        // Generate a random 4 digit number
        $pattient_number = mt_rand(1000, 9999);

        // Concatenate month, date and patient number
        $pattient_number = 'MM/' . $month + $date . '/' . $pattient_number;

        $check_pattient_number = Pattient::where('pattient_number', $pattient_number)->first();

        // Loop until a unique patient number is found
        while ($check_pattient_number) {
            $pattient_number = mt_rand(1000, 9999);
            $pattient_number = 'MM/' . $month + $date . '/' . $pattient_number;
            $check_pattient_number = Pattient::where('pattient_number', $pattient_number)->first();
        }
        //dd($pattient_number);
        $id = Auth::user()->member_id;
        $user_branch_id = member::where('id', $id)->first()->branch_id;
        //dd($user_branch_id);
        $pattient = new Pattient;
        $pattient->f_name = $request->f_name;
        $pattient->l_name = $request->l_name;
        $pattient->gender = $request->gender;
        $pattient->address = $request->address;
        $pattient->phone_number = $request->phone_number;
        $pattient->pattient_number = $pattient_number;
        $pattient->branch_id = $user_branch_id;
        $pattient->save();
        return redirect()->back()->with('success', 'Pattient Addedd successfully!');
    }

    //those Permission Issues
    public function AddPermission(Request $request)
    {
        //  return $request->all();
        $permission = array();
        foreach ($request->all() as $requestPerm) {
            if (is_numeric($requestPerm)) {
                $permission[] = $requestPerm;
            }
        }
        $rolename = Role::where('name', '=', $request->rolename)->first();
        $rolename->syncPermissions($permission);
        //dd($permission);

    }

    //Patient Details
    public function Patient_Details($PatientNumber)
    {
        $patientinfo = Pattient::where('pattient_number', $PatientNumber)->first();
        // Check if $patientinfo is not null before proceeding
        if ($patientinfo) {
            $medicsData = PatientDetails::where('patient_id', $patientinfo->id)->orderBy('created_at', 'Desc')->get();

            // Add the medicsData to the patientinfo object
            $patientinfo->medicsData = $medicsData;
        }

        return $patientinfo;
    }

    //searching for pattient
    public function SearchPatient(Request $request)
    {
        $patientNumber = $request->pattient_number;
        $select_patient = $this->Patient_Details($patientNumber);
        if (!$select_patient) {
            return redirect()->back()->with('error', 'Error: Patient with number ' . $patientNumber . ' does not exist!');
        } else {
            $branch = Branch::all();
            $member = member::get();
            $message = Message::orderBy('created_at', 'desc')->get();
            return view('pattientdetail', ['patientData' => $select_patient, 'branch' => $branch, 'member' => $member, 'messages' => $message]);
        }
    }

    //add patient medical records
    public function AddMedicalRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medics_type' => 'required',
            'hiv_level' => 'required',
            'medical_description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        $id = Auth::user()->member_id;
        $user_branch_id = member::where('id', $id)->first()->branch_id;
        PatientDetails::create([
            'patient_id' => $request->patient_id,
            'branch_id' => $user_branch_id,
            'doctor_id' => Auth::user()->id,
            'medics_type' => $request->medics_type,
            'HIV_level' => $request->hiv_level,
            'description' => $request->medical_description,
        ]);
        $patientNumber = $request->pattient_number;
        return redirect()->back()->with('success', 'Medical record addedd successfully!');
        // return $this->Patient_information($patientNumber)->with('success', 'Medical record added successfully!');
    }

    //get Pattient Data
    public function Patient_information($patientNumber)
    {
        $select_patient = $this->Patient_Details($patientNumber);
        $branch = Branch::all();
        //return view('pattientdetail', ['patientData' => $select_patient, 'branch' => $branch]);
        return redirect()->route('searchpatient')->with(['patientData' => $select_patient, 'branch' => $branch], 'success', 'Medical record added successfully!');
    }

    //delete medical record
    public function DeleteMedicalRecord(Request $request)
    {
        PatientDetails::where('id', $request->medicid)->delete();
        return redirect()->back()->with('success', 'Medical record deleted successfully!');
    }

    //send messages
    public function SendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        $id = Auth::user()->member_id;
        $user_branch_id = member::where('id', $id)->first()->branch_id;

        Message::create([
            'doctor_id' => Auth::user()->id,
            'branch_id' => $user_branch_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message is addedd successfully!');
    }

    //delete message
    public function DeleteMessage(Request $request)
    {
        Message::where('id', $request->messageid)->delete();
        return redirect()->back()->with('success', 'Response deleted successfully!');
    }
}
