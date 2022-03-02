<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemAPIController extends Controller
{
    public function getItems($category_id){
        $items = Item::all()->where('category_id', $category_id);
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
                'price' => $item->Figurine->figure_price,
                'description' => $item->Figurine->figure_description,
            ];

            $figurine_images = [];
            foreach($item->FigurineImages as $figurine_image){
                array_push($figurine_images,
                    asset('images/figurines/'.$figurine_image->image_path),
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
}
