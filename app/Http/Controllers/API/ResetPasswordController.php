<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {        
        $tokenExist = DB::table('password_resets')->where([
            
            ['email', $request->all()['email']]
        ])->exists();

        if($tokenExist){
            return new JsonResponse(['message' => 'Token not verified'], 403);
        }else{
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            
            if ($validator->fails()) {
                return new JsonResponse(['message' => $validator->errors()], 422);
            }
            
            $user = User::where('email',$request->email);
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            
            $token = $user->first()->createToken('myapptoken')->plainTextToken;
            
            return new JsonResponse(
                [
                    'message' => "Your password has been reset", 
                    'token'=>$token
                ], 
                200
            );
        }
    }
}
