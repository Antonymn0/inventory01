<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\LogoutSuccessful;
use App\Http\Requests\ValidateLogin;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;


class LogoutController extends Controller
{

    /**
     * logout user and revoke access token
     * 
     * @param request
     * @responce json
     */
    Public function logout(Request $request){
        
        if (Auth::user()) {
            $token = Auth::user()->token();
            $token->revoke();
            return response()->json([
                'success' => 'true',
                'message' => 'Logout successfull'
            ], 200);    
        }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
    }
}
