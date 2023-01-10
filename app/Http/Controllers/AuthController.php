<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //view the login page
    public function Login(){
        return view('/auth/login');
    }

    //chech auth validation
    public function authValidate(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //make authentication
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->route('home')->with('success', '[Login Successfully]');
        }else{
            return back()->with('error', 'Invalid Crediantial');
        }


    }

    //function to logout
    public function Logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Welcome back!');
    }

}
