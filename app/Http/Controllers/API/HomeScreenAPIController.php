<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\GameDescription;
use App\Models\Illustration;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class HomeScreenAPIController extends Controller
{
    public function newlyAddedItems(){
        $items = Item::orderBy('created_at', 'desc')->limit(10)->get();
        //$items->item_image = asset('images/items/'.$items->item_image);
        $response = [];
        foreach($items as $item){
            array_push($response,[
                'id' => $item->id, 
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'item_image' => asset('images/items/'.$item->item_image),
            ]);
        }

        return response($response,200);
    }

    public function getUpcomingGames(){
        $games = GameDescription::where('release_date', '>', date('Y-m-d'))->orderBy('release_date', 'asc')->limit(10)->get();
        $response = [];
        foreach($games as $game){
            array_push($response,[
                
                'id' => $game->Item->id, 
                'category_id' =>$game->Item->category_id,
                'item_image' => asset('images/items/'.$game->Item->item_image),
                'release_date' => $game->release_date->format('F d, Y'),
            ]);
        }
        return response($response);
    }

    public function getAds(){
        $ads = Ads::where('active', "true")->get();
        $response = [];
        foreach($ads as $ad){
            array_push($response,[
                'id' => $ad->id, 
                'title' => $ad->title,
                'description' => $ad->description,
                'image_url' => asset('images/ads/'.$ad->image_url),

                
            ]);
        }
        return response($response,200);
    }

    public function getArtist(){
        $artist = User::orderBy('updated_at', 'desc')->where('is_artist',1)->first();
        if($artist != null){
            
            $artist->profile_image = asset('images/profile/'.$artist->profile_image);
            
            $illustrations = Illustration::where('user_id',$artist->id)->get();
            $response = [];
            foreach($illustrations as $illustration){
                $illustration->Item->item_image = asset('images/items/'.$illustration->Item->item_image);
                array_push($response,$illustration->Item);
            }
            return response(['artist'=> $artist, 'illustrations'=>$response],200);
        }else{
            return response([],404);
        }
    }
}
