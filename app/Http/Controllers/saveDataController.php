<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\member;
use App\Models\Message;
use App\Models\PatientDetailItem;
use App\Models\PatientDetails;
use App\Models\Pattient;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Support\Facades\File;

//use Barryvdh\DomPDF\PDF;

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

        $highest_member_id = User::max('member_id');
        $new_member_id = $highest_member_id + 1;
        //create user and take the id and assign role
        $member = member::create([
            'id' => $new_member_id,
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
        $highest_member_id = User::max('member_id');
        $new_member_id = $highest_member_id + 1;

        $member = member::create([
            'id' => $new_member_id,
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

        $highest_member_id = User::max('member_id');
        $new_member_id = $highest_member_id + 1;
        //create user and take the id and assign role
        $member = member::create([
            'id' => $new_member_id,
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
            $medicsData = PatientDetails::join('patient_detail_items', 'patient_detail_items.patient_details_id', '=', 'patient_details.id')
                ->where('patient_id', $patientinfo->id)
                ->select(
                    'patient_details.*',
                    'patient_detail_items.*',
                )
                ->orderBy('patient_details.id', 'Desc')
                ->get();

            $patientinfo->medicsData = $medicsData;
        }



        return $patientinfo;
    }

    //searching for pattient
    public function SearchPatient(Request $request)
    {

        $select_patient = $this->Patient_Details($request->pattient_number);
        // return ($select_patient);
        if (!$select_patient) {
            return redirect()->back()->with('error', 'Error: Patient with number ' . $request->pattient_number . ' does not exist!');
        }


        $data = [
            'patient' => $select_patient
        ];

        // return view('check_patient_exist')->with($data);

        $branch = Branch::all();
        $member = member::get();
        $message = Message::orderBy('created_at', 'desc')->get();
        return view('pattientdetail', ['patientData' => $select_patient, 'branch' => $branch, 'member' => $member, 'messages' => $message]);
    }

    //add patient medical records
    public function AddMedicalRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medics_type' => 'required',
            'hiv_level' => 'required',
            'medical_description' => 'required',
            'viral_load' => 'required',
            'cd4_count' => 'required',
            'allergies' => 'required',
            'blood_pressure' => 'required',
            'medication_adherence' => 'required',
            'weight' => 'required',
            'art_regimen' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->getMessageBag());
        }

        $id = Auth::user()->member_id;
        $user_branch_id = member::where('id', $id)->first()->branch_id;

        try {
            DB::beginTransaction();
            $patient_detail = PatientDetails::create([
                'patient_id' => $request->patient_id,
                'branch_id' => $user_branch_id,
                'doctor_id' => Auth::user()->id,
                'medics_type' => $request->medics_type,
                'HIV_level' => $request->hiv_level,
                'description' => $request->medical_description
            ]);

            PatientDetailItem::create([
                'patient_details_id' => $patient_detail->id,
                'viral_load' => $request->viral_load,
                'cd4_count' => $request->cd4_count,
                'allergies' => $request->allergies,
                'blood_pressure' => $request->blood_pressure,
                'medication_adherence' => $request->medication_adherence,
                'diagnosis_date' => $request->diagnosis_date,
                'weight' => $request->weight,
                'art_regimen' => $request->art_regimen,
                'next_appointment_date' => null, //will be filled in later with doctor 
                'status' => 0
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Medical record addedd successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //get Pattient Data
    public function Patient_information($patientNumber)
    {
        $select_patient = $this->Patient_Details($patientNumber);
        $branch = Branch::all();
        // dd('test');
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

    //generate report function
    public function generateReport(Request $request)
    {
        $patientNumber = $request->patientNumber;
        $select_patient = $this->Patient_Details($patientNumber);
        if (!$select_patient) {
            return redirect()->back()->with('error', 'Error: We could not print patient information');
        } else {
            $branch = Branch::get();
            $member = member::get();
            $message = Message::orderBy('created_at', 'desc')->get();

            // return view('pattientdetail', ['patientData' => $select_patient, 'branch' => $branch, 'member' => $member, 'messages' => $message]);
            $firstName = member::where('id', Auth::user()->member_id)->first()->f_name;
            $lastName = member::where('id', Auth::user()->member_id)->first()->l_name;
            $fullName = $firstName . ' ' . $lastName;
            $pdf = PDF::loadView('patientReport',  ['patientData' => $select_patient, 'branch' => $branch, 'member' => $member, 'fullName' => $fullName]);

            return $pdf->download('Patient-' . $patientNumber . '.pdf');
        }
    }

    public function seedEvent()
    {
        Artisan::call('migrate:fresh --seed');
        return response()->json('Succcess');
    }

    //call Optimize Event
    public function optimizeEvent()
    {
        Artisan::call('optimize:clear');
        return response()->json('Succcess');
    }

    //call clear Event
    public function configEvent()
    {
        Artisan::call('config:clear');
        return response()->json('Succcess');
    }

    //call clear Event
    public function cacheEvent()
    {
        Artisan::call('cache:clear');
        return response()->json('Succcess');
    }
}
