<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Http\Request;

class CartAPIController extends Controller
{
    public function addToCart(Request $request){
        $user_id = auth()->user()->id;
        //Create a Cart if no cart was found
        if(Cart::all()->where('user_id', $user_id)->first() == null){
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->save();
        }

        $cart_id = Cart::all()->where('user_id', $user_id)->first()->id;
        $cart_item = new CartItems([
            'cart_id' => $cart_id,
            'item_id' => $request->item_id,
            'quantity' => 1,
            'option' => $request->option,
        ]);

        $cart_item->save();

        return response()->json(['message' => 'Item added to cart'], 201);
    }

    public function getCart(Request $request){
        $user_id = auth()->user()->id;

        
        if(Cart::all()->where('user_id', $user_id)->first() == null){
            return response()->json(['message' => 'No cart found'], 404);
        }else{
            $cart_id = Cart::all()->where('user_id', $user_id)->first()->id;
            $cart_items = CartItems::all()->where('cart_id', $cart_id);
            $items = [];
            $total_price = 0;
            foreach($cart_items as $cart_item){
                array_push($items, [
                    'cart_item_id' => $cart_item->id,
                    'item_id' => $cart_item->item_id,
                    'quantity' => $cart_item->quantity,
                    'option' => $cart_item->option,
                ]);

                $total_price += $this->getItemPrice($cart_item,$cart_item->option) * $cart_item->quantity;
        }



        $response = [
            'items' => $items,
            'total_price' => $total_price
        ];
    
        return response($response, 200);
        }
    }

    private static function getItemPrice(CartItems $cartItem, String $option){
        switch($cartItem->Item->category_id){
            case 7:
                if($option == 'physical'){
                    return $cartItem->Item->Music->physical_price;
                }else{
                    return $cartItem->Item->Music->digital_price;
                }
        }
    }

    public function removeFromCart(Request $request){
        $user_id = auth()->user()->id;
        $cart_id = Cart::all()->where('user_id', $user_id)->first()->id;
        $cart_item = CartItems::all()->where('cart_id', $cart_id)->where('id', $request->cart_item_id)->first();
        if($cart_item == null){
            return response()->json(['message' => 'No cart item found'], 404);
        }else{
            $cart_item->delete();
            return response()->json(['message' => 'Item deleted from cart'], 200);
        }
    }

    public function increaseQuantity(Request $request){
        $user_id = auth()->user()->id;
        $cart_id = Cart::all()->where('user_id', $user_id)->first()->id;
        $cart_item = CartItems::all()->where('cart_id', $cart_id)->where('id', $request->cart_item_id)->first();
        if($cart_item == null){
            return response()->json(['message' => 'No cart item found'], 404);
        }else{
            $cart_item->quantity += 1;
            $cart_item->save();
            return response()->json(['message' => 'Item quantity increased'], 200);
        }
    }

    public function decreaseQuantity(Request $request){
        $user_id = auth()->user()->id;
        $cart_id = Cart::all()->where('user_id', $user_id)->first()->id;
        $cart_item = CartItems::all()->where('cart_id', $cart_id)->where('id', $request->cart_item_id)->first();
        if($cart_item == null){
            return response()->json(['message' => 'No cart item found'], 404);
        }else{
            if($cart_item->quantity > 1){
                $cart_item->quantity -= 1;
                $cart_item->save();
                return response()->json(['message' => 'Item quantity decreased'], 200);
            }else{
                return response()->json(['message' => 'Item quantity cannot be decreased'], 400);
            }
        }
    }
}
