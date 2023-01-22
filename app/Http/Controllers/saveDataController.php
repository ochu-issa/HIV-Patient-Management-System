<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchAdmin;
use App\Models\Receptionist;
use App\Models\Doctor;
use App\Models\member;
use App\Models\Pattient;
use App\Models\User;
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
        ])->assignRole('Branch-Admin');

        //select role id and insert into User table
        $role_id = Role::where('name', 'Branch-Admin')->first()->id;
        User::create([
            'member_id' => $member->id,
            'role_id' => $role_id,
            'password' => Hash::make('password'),
        ]);

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
         ])->assignRole('Receptionist');

        //select role id and insert into User table
        $role_id = Role::where('name', 'Receptionist')->first()->id;
        User::create([
            'member_id' => $member->id,
            'role_id' => $role_id,
            'password' => Hash::make('password'),
        ]);

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
        ])->assignRole('Doctor');

        //select role id and insert into User table
        $role_id = Role::where('name', 'Doctor')->first()->id;
        User::create([
            'member_id' => $member->id,
            'role_id' => $role_id,
            'password' => Hash::make('password'),
        ]);
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
        $pattient = new Pattient;
        $pattient->f_name = $request->f_name;
        $pattient->l_name = $request->l_name;
        $pattient->gender = $request->gender;
        $pattient->address = $request->address;
        $pattient->phone_number = $request->phone_number;
        $pattient->pattient_number = $pattient_number;
        $pattient->branch_id = 1;
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
}
