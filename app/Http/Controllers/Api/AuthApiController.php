<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request)
    {
        $request->validated($request->all());

        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password]))
        {
            return $this->error('', 'Invalid Crediantials', 401);
        }

        $user = User::where('username', $request->username)->first();
        $token = $user->createToken('Api Token for'. $user->username)->plainTextToken;

        return $this->success([
            'full_name' => $user->pattient->f_name. ' ' .$user->pattient->l_name,
            'gender' => $user->pattient->gender,
            'address' => $user->pattient->address,
            'phone' => $user->pattient->phone_number,
            'registered_branch' => $user->pattient->Branch->branch_name,
            'token' => $token
        ],'Date Retrieved');
    }

    //logout 
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have successfully logout.'
        ]);
    }
}
