<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        $token = $user->createToken('mytoken')->plainTextToken;

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
        
        $user->profile_image = asset('images/profile/'.$user->profile_image);
        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,200);
    }

    //Logout Function
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response(['message' => 'Successfully logged out']);
    }

    public function getUser(Request $request){
        $user = $request->user();
        $user->profile_image = asset('images/profile/'.$user->profile_image);
        return response($user);
    }

    public function editUserProfile(Request $request){
        $user = $request->user();
        error_log($request->name);
        error_log($request->hasFile('image'));
        if($request->has('name')){
            $user->name = $request->name;
        }
        if($request->hasFile('image')){
            error_log('image found');
            $itemImage = time().preg_replace('/\s+/', '', $request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('images/profile/'), $itemImage);
            $user->profile_image = $itemImage;         
        }
        $user->save();
        return response($user,200);
    }
}
