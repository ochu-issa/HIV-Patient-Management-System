<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchAdmin;
use App\Models\Receptionist;
use App\Models\Doctor;

class saveDataController extends Controller
{
    //this method for branch CRUD
    public function saveData(Request $request)
    {
        //validating data
        $validator = Validator::make($request->all(), [
            'branchname' => 'required|regex:/^[a-zA-Z\s]+$/',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        //send data in database
        $branch = new Branch();
        $branch->branch_name = $request->input('branchname');
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
            'email' => 'required|email|unique:branch_admins',
            'phone_number' => 'required|numeric|unique:branch_admins',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        $branchAdmin = new BranchAdmin;
        $branchAdmin->f_name = $request->f_name;
        $branchAdmin->l_name = $request->l_name;
        $branchAdmin->gender = $request->gender;
        $branchAdmin->email = $request->email;
        $branchAdmin->phone_number = $request->phone_number;
        $branchName = $request->branchname;

        $branch = Branch::where('branch_name', $branchName)->first();
        $branchAdmin->branch_id = $branch->id;

        $branchAdmin->save();
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
            'email' => 'required|email|unique:receptionists',
            'phone_number' => 'required|numeric|unique:receptionists',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        $receptionist = new Receptionist();
        $receptionist->f_name = $request->f_name;
        $receptionist->l_name = $request->l_name;
        $receptionist->gender = $request->gender;
        $receptionist->email = $request->email;
        $receptionist->phone_number = $request->phone_number;
        $branchName = $request->branchname;

        $branch = Branch::where('branch_name', $branchName)->first();
        $receptionist->branch_id = $branch->id;
        $receptionist->save();

        return redirect()->route('receptionist')->with('success', 'Receptionist Addedd successfully!');
    }

    //this is CRUD for Doctor
    public function AddDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|email|unique:receptionists',
            'phone_number' => 'required|numeric|unique:receptionists',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Error: Something went wrong!');
        }

        $doctor = new Doctor;
        $doctor->f_name = $request->f_name;
        $doctor->l_name = $request->l_name;
        $doctor->gender = $request->gender;
        $doctor->email = $request->email;
        $doctor->phone_number = $request->phone_number;

        $branchId = Branch::where('branch_name', $request->branchname)->first();
        $doctor->branch_id = $branchId->id;
        $doctor->save();
        return redirect()->back()->with('success', 'Doctors Addedd successfully!');
       //dd('test');
    }
}
