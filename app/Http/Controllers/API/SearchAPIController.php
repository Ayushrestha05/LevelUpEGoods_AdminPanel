<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchAPIController extends Controller
{
    public function search(Request $request){
        //search items
        if($request->filter == 8){
            $items = \App\Models\Item::orderBy('item_name', $request->sort_name)->where(DB::raw('lower(item_name)'), 'like', '%'.Str::lower($request->search).'%')->get();
        }else{
            $items = \App\Models\Item::orderBy('item_name', $request->sort_name)->where(DB::raw('lower(item_name)'), 'like', '%'.Str::lower($request->search).'%')->where('category_id',$request->filter)->get();
        }
        $response = [];
        foreach($items as $item){
            array_push($response, [
                "id"=> $item->id,
                "category_id"=> $item->category_id,
                "item_name"=> $item->item_name,
                "item_description"=> $item->item_description,
                "item_image"=> asset("images/items/".$item->item_image),
                "additional"=> $item->additional,
            ]);
        }
        return response($response, 200);
        
    }
}
