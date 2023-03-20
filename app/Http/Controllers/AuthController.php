<?php

namespace App\Http\Controllers;

use App\Models\BranchAdmin;
use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\member;
use Auth;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //view the login page
    public function Login()
    {
        return view('/auth/login');
    }

    //chech auth validation
    public function authValidate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $member = member::where('email', $request->email)->first();
        //dd($member)
        if (!$member) {
            return redirect()->back()->with('error', '[Invalid Crediantials]');
        }
        else
        {
            $member_id = $member->id;
            //make authentication
            if (Auth::attempt(['member_id' => $member_id, 'password' => $request->password]))
            {
                return redirect()->route('home')->with('success', '[Login Successfully]');
            }
            else
            {
                return redirect()->back()->with('error', '[Invalid Crediantials]');
            }
        }
    }

    //function to logout
    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Welcome back!');
    }
}
