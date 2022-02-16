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
                'item_image' => asset('images/items/'.$item->item_image),
            ]);
        }
        return response($response,200);
    }
}
