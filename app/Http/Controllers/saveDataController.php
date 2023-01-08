<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class saveDataController extends Controller
{
    //this method for branch CRUD
    public function saveData(Request $request){
        //validate input
        $this->validate($request, [
            'branchname' => 'required|regex:/^[a-zA-Z\s]+$/',
        ]);
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
    public function deleteBranch($id){
        //find the branch with specific id
        $branch = Branch::find($id);

        //delete branch
        $branch->delete();

        // Redirect to the branches page
        return redirect()->route('branches');

    }

    //update branch record
    public function updateRecord(Request $request, $id){
        //validate the input
        $this->validate($request, [
            'branch_name' => 'required|regex:/^[a-zA-Z\s]+$/',
        ]);

        //find the id
        $branch = Branch::find($id);

        //save the data
        $branch->branch_name = $request->input('branch_name');
        $branch->save();

        return redirect()->route('branches')->with('success', 'Branch updated successfully!');
    }

    //update branch status
    public function updateStatus(Request $request, $id){
        //find branch id
        $branch = Branch::find($id);

        //save new status
        $branch->status = 0;
        $branch->save();

        return redirect()->route('branches')->with('success', 'The branch now is Unactive');
    }


}
