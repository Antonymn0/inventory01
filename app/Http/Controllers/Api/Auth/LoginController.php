<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\LoginSuccessful;
use App\Http\Requests\ValidateLogin;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class LoginController extends Controller
{
     /**
     *  login user
     * 
     * @param App\Http\Requests\ValidateUser; $request
     * @return responce json, $token
     */
    Public function login(ValidateLogin $request){
            $credentials = $request->validated();            
            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized' ], 401);
            }
            $user = Auth::user();
            $token =    $user->createToken('access_token')-> accessToken;         
            event(new LoginSuccessful($user));
            return response()->json(['success'=>'Login successful', 'data'=>$user, 'token' => $token]);
    }
}
