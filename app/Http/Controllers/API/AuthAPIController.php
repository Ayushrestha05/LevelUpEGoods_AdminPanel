<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


class AuthAPIController extends Controller
{
    //Register Function
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('registertoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    //Login Function
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Check if user exists
        $user = User::where('email',$fields['email'])->first();

        //Check password
        if( !$user || !Hash::check($fields['password'],$user->password)){
            return response(['message' => 'Invalid credentials'],401);
        }
        

        $token = $user->createToken('logintoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    //Logout Function
    public function logout(Request $request){
        if ($request->user()) { 
            $request->user()->tokens()->revoke();
            return [
                'message' => 'Logged out'
            ];
        }else{
            return [
                'message' => 'User hasn\'t logged in'
            ];
        }        
    }
}
