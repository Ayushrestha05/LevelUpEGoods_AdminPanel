<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemAPIController extends Controller
{
    public function getItems($category_id){
        if($category_id == 8){
            $items = Item::all();
        }else{
            $items = Item::all()->where('category_id', $category_id);
        }
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

    public function getMusicData($item_id){
        $item = Item::all()->where('id', $item_id)->first();
        $response = [];
        if($item->category_id != 7){
            return response(['error' => 'Not a Music Item'],400);
        }else{
            $item_details = [
                'id' => $item->id, 
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'item_image' => asset('images/items/'.$item->item_image),
            ];
            $album_details = [
                'album_type' => $item->Music->music_type,
                'digital_price' => $item->Music->digital_price,
                'physical_price' => $item->Music->physical_price,
            ];

            $album_tracks = [];
            $music_tracks = Item::find($item_id)->MusicTracks;
            foreach($music_tracks as $music_track){
                array_push($album_tracks,[
                    'id' => $music_track->id, 
                    'track_name' => $music_track->track_name,
                    'track_time' => $music_track->track_time,
                    'track_file' => asset('music/'.$music_track->track_file),
                ]);
            }
            array_push($response,[
                'item_details' => $item_details,
                'album_details' => $album_details,
                'album_tracks' => $album_tracks,
            ]);

            return response($response,200);
            
        }   
    }    

    public function getGiftCardData($item_id){
        $item = Item::all()->where('id', $item_id)->first();
        $response = [];
        if($item->category_id != 1){
            return response(['error' => 'Not a Gift Card Item'],400);
        }else{
            $item_details = [
                'id' => $item->id, 
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'item_image' => asset('images/items/'.$item->item_image),
            ];

            $gift_card_details = [];
            foreach($item->GiftCard as $gift_card){
                array_push($gift_card_details,[
                    'id' => $gift_card->id, 
                    'card_type' => $gift_card->card_type,
                    'card_price' => $gift_card->card_price,
                ]);
            }

            array_push($response,[
                'item_details' => $item_details,
                'gift_card_details' => $gift_card_details,
            ]);

            return response($response,200);
            
        }   
    }

    public function getFigurineData($item_id){
        $item = Item::all()->where('id', $item_id)->first();

        if($item->category_id != 3){
            return response(['error' => 'Not a Figurine Item'],400);
        }else{
            $item_details = [
                'id' => $item->id, 
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'item_image' => asset('images/items/'.$item->item_image),
            ];

            $figurine_details = [
                'figurine_height' => $item->Figurine->figure_height,
                'figurine_dimension' => $item->Figurine->figure_dimension,
                'price' => $item->Figurine->figure_price,
                'description' => $item->Figurine->figure_description,
            ];

            $figurine_images = [];
            $images = explode('|',$item->FigurineImages->image_path);
         
            foreach($images as $figurine_image){
                array_push($figurine_images,
                    asset('images/figurines/'.$figurine_image),
                );
            }
        }


        $response = [
            'item_details' => $item_details,
            'figurine_details' => $figurine_details,
            'figurine_images' => $figurine_images,
            
        ];
        return response($response,200);
    }

    public function getIllustrationData($item_id){
        $item = Item::all()->where('id', $item_id)->first();
        if($item->category_id != 2){
            return response(['error' => 'Not a Illustration Item'],400);
        }else{
            $item_details = [
                'id' => $item->id, 
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'item_image' => asset('images/illustration/'.$item->item_image),
            ];

            
            if($item->Illustration->user_id != null){
                $illustration_details = [
                    'illustration_description' => $item->Illustration->illustration_description,
                    'user_id' => $item->Illustration->user_id,
                    'user_name' => $item->Illustration->User->name,
                    'creator' => $item->Illustration->creator,
                ];
            }else{
                $illustration_details = [
                    'illustration_description' => $item->Illustration->description,
                    'user_id' => null,
                    'user_name' => '',
                    'creator' => $item->Illustration->creator,
                ];
            }

            $illustration_prices = [];
    
            foreach($item->IllustrationPrice as $illustration_price){
                array_push($illustration_prices,[ 
                    'price' => $illustration_price->price,
                    'size' => $illustration_price->size,
                    'id' => $illustration_price->id,
                ]);
            }

            return response([
                'item_details' => $item_details,
                'illustration_details' => $illustration_details,
                'illustration_prices' => $illustration_prices,
            ],200);
        }
    }

    public function getGameData($item_id){
        $item = Item::all()->where('id', $item_id)->first();
        if(in_array($item->category_id, [4,5,6])){
            $item_details = [
                'id' => $item->id, 
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'item_image' => asset('images/items/'.$item->item_image),
                'item_description' => $item->item_description,
            ];

            $game_description = [
                'release_date' => $item->GameDescription->release_date,
                'trailer_url' => $item->GameDescription->trailer_url,
            ];

            $game_images = [];
            $images = explode('|',$item->GameDescription->image_url);
         
            foreach($images as $game_image){
                array_push($game_images,
                    asset('images/games/'.$game_image),
                );
            }

            $game_prices = [];
            foreach($item->GamePrices as $game_price){
                array_push($game_prices,[ 
                    'id' => $game_price->id,
                    'platform_id' => $game_price->platform_id,
                    'platform_name' => $game_price->Platform->name,
                    'platform_logo' => asset('images/platforms/'.$game_price->Platform->icon_filename),
                    'price' => $game_price->price,
                ]);
            }

            return response([
                'item_details' => $item_details,
                'game_description' => $game_description,
                'game_images' => $game_images,
                'game_prices' => $game_prices,
            ],200);

        }else{
            return response(['error' => 'Not a Game Item'],400);
        }
            
    }
}
