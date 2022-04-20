<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
       $this->validate($request,[
           'name'=>'required',
           'email'=>'required|unique:users',
           'password'=>'required|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json([
            'status'=>1,
            'message'=>'User Registered Successfully',
        ]);
    }
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
           'password'=>'required'
        ]);
        if(!$token = auth()->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return response()->json([
                'status'=>0,
                'message'=>'invalid credentials',
            ]);

        }
        return response()->json([
                'status'=>1,
                'message'=>"user logged in successfully",
                'access_token'=>$token,
        ]);

    }
    public function profile()
    {
        $user_data = auth()->user();
        return response()->json([
           'status'=>1,
            'message'=>"user profile data",
            'data'=>$user_data
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status'=>1,
            'message'=>'user logged out'
        ]);
    }
}
