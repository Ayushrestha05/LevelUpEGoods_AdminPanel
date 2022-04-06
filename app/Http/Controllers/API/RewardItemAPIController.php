<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RewardHistory;
use App\Models\RewardItem;
use App\Models\User;
use Illuminate\Http\Request;

class RewardItemAPIController extends Controller
{
    public function getRewardItems(){
        $reward_items = [];
        foreach(RewardItem::all() as $item){
            array_push($reward_items,[
                'id' => $item->id,
                'item_name' => $item->item_name,
                'reward_points' => $item->reward_points,
                'stock' => $item->stock,
                'item_image' => asset('images/reward-items/'.$item->item_image),
            ]);
        }
        return response()->json($reward_items);
    }

    public function redeemReward(Request $request){

        $user_id = auth()->user()->id;
        $user_point = auth()->user()->points;
        $reward_item = RewardItem::where('id',$request->reward_id)->first();
        if($user_point >= $reward_item->reward_points){
            if($reward_item->stock > 0){
                $reward_history = new RewardHistory([
                    'user_id' => $user_id,
                    'reward_id' => $request->reward_id,
                    'status' => 'pending',
                ]);
                $reward_history->save();

                $reward_item->stock -= 1;
                $reward_item->save();

                $user = User::where('id',$user_id)->first();
                $user->points -= $reward_item->reward_points;
                $user->save();
                return response()->json(['message' => 'Reward redeemed successfully']);
            }
            return response()->json(['message' => 'Reward item is out of stock'],422);
        }else{
            return response()->json(['message' => 'Insufficient points'],422);
        }
    }

    public function getRewardHistory(){
        $reward_history = [];
        foreach(RewardHistory::where('user_id',auth()->user()->id)->get() as $history){
            array_push($reward_history,[
                'id' => $history->id,
                'reward_id' => $history->reward_id,
                'status' => $history->status,
                'created_at' => $history->created_at->format('d-F-Y'),
                'reward_item' => RewardItem::where('id',$history->reward_id)->first()->item_name,
                'reward_image' => asset('images/reward-items/'.RewardItem::where('id',$history->reward_id)->first()->item_image),
            ]);
        }
        return response()->json($reward_history);
    }
}
