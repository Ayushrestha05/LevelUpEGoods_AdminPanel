<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationHistoryAPIController extends Controller
{
    public function getNotificationHistory(Request $request){
        $notifications = DB::select('SELECT * FROM `push_notifications` ORDER BY created_at DESC LIMIT 10;');
        if(count($notifications) > 0){
            return response()->json([
      
                'notifications' => $notifications
            ]);
        }else{
            return response()->json([],404);
        }
    }
}
