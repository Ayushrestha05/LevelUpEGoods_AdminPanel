<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Platform;
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

        $cart = Cart::all()->where('user_id', $user_id)->first();
        $existItem = $cart->cartItems->where('item_id',$request->item_id);
        if($existItem->count() > 0){
            $item = $existItem->where('option',$request->option)->first();
            if($item != null){
                switch($item->Item->category_id){
                    case 1:
                        if($item->quantity > 4){
                            return response()->json(['message' => 'Gift cards are limited to 5 per cart'], 400);
                        }else{
                            $item->quantity += 1;
                            $item->save();
                            return response()->json(['message' => 'Item quantity increased'], 200);
                        }
        
                    case 2:
                        if($item->quantity > 1){
                            return response()->json(['message' => 'Illustrations are limited to 2 per cart'], 400);
                        }else{
                            $item->quantity += 1;
                            $item->save();
                            return response()->json(['message' => 'Item quantity increased'], 200);
                        }
        
                    case 3:
                        if($item->quantity > 2){
                            return response()->json(['message' => 'Figurines are limited to 3 per cart'], 400);
                        }else{
                            $item->quantity += 1;
                            $item->save();
                            return response()->json(['message' => 'Item quantity increased'], 200);
                        }
        
                    case 4:
                    case 5:
                    case 6:
                        if($item->quantity > 1){
                            return response()->json(['message' => 'Games are limited to 2 per cart'], 400);
                        }else{
                            $item->quantity += 1;
                            $item->save();
                            return response()->json(['message' => 'Item quantity increased'], 200);
                        }
        
                    case 7:
                        if($item->quantity > 4){
                            return response()->json(['message' => 'Music is limited to 5 per cart'], 400);
                        }else{
                            $item->quantity += 1;
                            $item->save();
                            return response()->json(['message' => 'Item quantity increased'], 200);
                        }
                }
            }else{
                $cart_item = new CartItems([
                    'cart_id' => $cart->id,
                    'item_id' => (int)$request->item_id,
                    'quantity' => 1,
                    'option' => $request->option,
                ]);
                $cart_item->save();
                
                return response()->json(['message' => 'Item added to cart'], 201);
            }
            
        }else{
            $cart_item = new CartItems([
                'cart_id' => $cart->id,
                'item_id' => (int)$request->item_id,
                'quantity' => 1,
                'option' => $request->option,
            ]);
            $cart_item->save();

            return response()->json(['message' => 'Item added to cart'], 201);
        }
        


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
                    'item_name' => $cart_item->Item->item_name,
                    'item_image' => asset('images/items/'.$cart_item->Item->item_image),
                    'category' => $cart_item->Item->category_id,
                    'quantity' => $cart_item->quantity,
                    'option' => $cart_item->option,
                    'current_price' => $this->getItemPrice($cart_item,$cart_item->option) * $cart_item->quantity,
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

    private static function getItemPrice(CartItems $cartItem, $option){
 
        switch($cartItem->Item->category_id){
            case 1:
                return $cartItem->Item->GiftCard->where('card_type', $option)->first()->card_price;
            
            case 2:
                return $cartItem->Item->IllustrationPrice->where('size',$option)->first()->price;

            case 3:
                return $cartItem->Item->Figurine->figure_price;

            case 4:
            case 5:
            case 6:
                $price = $cartItem->Item->GamePrices->where('platform_id', Platform::all()->where('name',$option)->first()->id)->first()->price;
                return $price;

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
            switch($cart_item->Item->category_id){
                case 1:
                    if($cart_item->quantity > 4){
                        return response()->json(['message' => 'Gift cards are limited to 5 per cart'], 400);
                    }else{
                        $cart_item->quantity += 1;
                        $cart_item->save();
                        return response()->json(['message' => 'Item quantity increased'], 200);
                    }
    
                case 2:
                    if($cart_item->quantity > 1){
                        return response()->json(['message' => 'Illustrations are limited to 2 per cart'], 400);
                    }else{
                        $cart_item->quantity += 1;
                        $cart_item->save();
                        return response()->json(['message' => 'Item quantity increased'], 200);
                    }
    
                case 3:
                    if($cart_item->quantity > 2){
                        return response()->json(['message' => 'Figurines are limited to 3 per cart'], 400);
                    }else{
                        $cart_item->quantity += 1;
                        $cart_item->save();
                        return response()->json(['message' => 'Item quantity increased'], 200);
                    }
    
                case 4:
                case 5:
                case 6:
                    if($cart_item->quantity > 1){
                        return response()->json(['message' => 'Games are limited to 2 per cart'], 400);
                    }else{
                        $cart_item->quantity += 1;
                        $cart_item->save();
                        return response()->json(['message' => 'Item quantity increased'], 200);
                    }
    
                case 7:
                    if($cart_item->quantity > 4){
                        return response()->json(['message' => 'Music is limited to 5 per cart'], 400);
                    }else{
                        $cart_item->quantity += 1;
                        $cart_item->save();
                        return response()->json(['message' => 'Item quantity increased'], 200);
                    }
            }
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
