<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateUser;
use App\Events\UserCreated;
use App\Events\UserUpdated;
use App\Events\UserDestroyed;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{



    /**
     *  register new user
     * 
     * @param App\Http\Requests\ValidateUser; $request
     * @return responce json
     */
    Public function RegisterUser(ValidateUser $request){
            $input = $request->validated();
            $input['password'] = Hash::make($request->password);
            $user = User::create($input);
            event(new UserCreated($user));
            return response()->json(['success'=>'New user created successfuly', $user]);
    }

     /**
     *  show specified  user
     * 
     * @param int $id
     * @return responce json
     */
    Public function show($id){
        $user = User::findOrFail($id);
        return response()->json(['success'=>'success', $user]);
    }

    /**
     *  updated user record
     * 
     * @param App\Http\Requests\ValidateUser; $request
     * @return responce json
     */
    Public function update(ValidateUser $request, $id){
        $input = $request->validated();
        $input['password'] = Hash::make($request->password);
        $user = User::findOrFail($id);
        $user -> update($input);
        event(new UserUpdated($user));
        return response()->json(['success'=>'New user created successfuly', $user]);
    }

    /**
     *  delete  user
     * 
     * @param int $id
     * @return responce json
     */
    Public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        event(new UserDestroyed($user));
        return response()->json(['success'=>'user deleted successfuly', $user]);
    }
}
