<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PointsAPIController extends Controller
{
    public function getUserPoints(Request $request){
        $user = User::where('id',auth()->user()->id)->first();
        return response()->json([
            'points' => $user->points
        ]);
    }
}
