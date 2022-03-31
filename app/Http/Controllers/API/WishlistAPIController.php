<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistAPIController extends Controller
{
    public function addToWishlist(Request $request){
       $exists = Wishlist::where('user_id', auth()->user()->id)->where('item_id', $request->item_id)->exists();
         if($exists){
              return response()->json(['message' => 'Item already in wishlist'],208);
         }else{
            $wishlist = new Wishlist();
            $wishlist->user_id = auth()->user()->id;
            $wishlist->item_id = $request->item_id;
            $wishlist->save();
            return response()->json(['message' => 'Item added to wishlist'],200);
         }

    }

    public function removeFromWishlist(Request $request){
        $exists = Wishlist::where('user_id', auth()->user()->id)->where('item_id', $request->item_id)->exists();
        if($exists){
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('item_id', $request->item_id)->first();
            $wishlist->delete();
            return response()->json(['message' => 'Item removed from wishlist'],200);
        }else{
            return response()->json(['message' => 'Item not in wishlist'],404);
        }
    }

    public function getWishlist(Request $request){
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        $wishlistList = [];
        foreach($wishlist as $wishlist_item){
            array_push($wishlistList,[
                'wishlist_id' => $wishlist_item->id,
                'item_id' => $wishlist_item->item_id,
                'item_name' => $wishlist_item->Item->item_name,
                'item_image' => asset('images/items/'.$wishlist_item->Item->item_image),
                'category' => $wishlist_item->Item->category_id,
            ]);
        }
        $response = [
            'wishlist' => $wishlistList,
        ];
        return response()->json($response,200);
    }

    public function inWishlist(Request $request, $item_id){
        $exists = Wishlist::where('user_id', auth()->user()->id)->where('item_id', $item_id)->exists();
        if($exists){
            return response()->json(['message' => 'Item in wishlist'],200);
        }else{
            return response()->json(['message' => 'Item not in wishlist'],404);
        }
    }
}
