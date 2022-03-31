<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class PaymentVerificationAPIController extends Controller
{
    public function validatePayment(Request $request){
        $args = http_build_query(array(
            'token' => $request->token,            
            'amount' => $request->amount,            
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_b3e15bbfaf4745539f02e1260794f8a1'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = json_decode($response, true);
        
        if($status_code == 200){
            $cart = Cart::all()->where('user_id',auth()->user()->id)->first();
            $cart_items = CartItems::all()->where('cart_id',$cart->id);
            $order = new Order([
                'user_id' => auth()->user()->id,
                'txn_id' => $response["idx"],
                'amount' => ($request->amount / 100),
                'reciever_name' => $request->recieverName,
                'reciever_phone' => $request->recieverPhone,
                'reciever_city' => $request->recieverCity,
                'reciever_address' => $request->recieverAddress,
                'sender_message' => $request->senderMessage,
                'hidden' => $request->nonTransparentBag,
                'wrapped' => $request->giftWrap,
                'status' => 'pending'
            ]);
            $order->save();
            $order_id = $order->id;
            foreach($cart_items as $cart_item){
                $order_item = new OrderItems([
                    'order_id' => $order_id,
                    'item_id' => $cart_item->item_id,
                    'quantity' => $cart_item->quantity,
                    'option' => $cart_item->option,
                ]);
                $order_item->save();
            }
            $cart->delete();
            return response(['success' => 'Payment Successful'],200);
        }
        else{
            return response(['error' => 'Payment Failed'],400);
        }
        
    }
}
