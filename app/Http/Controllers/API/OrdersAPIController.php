<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Platform;
use Illuminate\Http\Request;

class OrdersAPIController extends Controller
{
    public function getOrders(Request $request){
        $user_id = auth()->user()->id;
        if($request->filter == 'all'){
            $orders = Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        }else{
            $orders = Order::where('user_id', $user_id)->where('status',$request->filter)->orderBy('created_at', 'desc')->get();
        }
        $orders_response = [];
        foreach($orders as $order){
            
            array_push($orders_response,[
                'id' => $order->id,
                'txn_id' => $order->txn_id,
                'status' => $order->status,
                'amount' => $order->amount,
                'created_at' => $order->created_at->format('Y M d'),                
            ]);
          
        }
        return response($orders_response,200);
    }

    public function getOrderDetails(Request $request, $order_id){
    
        $order = Order::where('id',$order_id)->first();
        $order_items = OrderItems::where('order_id',$order_id)->get();
        $items = [];
        foreach($order_items as $order_item){
            array_push($items,[
                'id' => $order_item->id,
                'item_id' => $order_item->item_id,
                'quantity' => $order_item->quantity,
                'option' => $order_item->option,
                'category' => $order_item->Item->category_id,
                'item_name' => $order_item->Item->item_name,
                'item_image' => asset('images/items/'.$order_item->Item->item_image),
                'unit_price' => $this->getItemPrice($order_item, $order_item->option),
                'total_price' => $this->getItemPrice($order_item, $order_item->option) * $order_item->quantity,
            ]);
        }
        $response = [];
        array_push($response,[
            'order' => [
                'id' => $order->id,
                'txn_id' => $order->txn_id,
                'status' => $order->status,
                'amount' => $order->amount,
                'created_at' => $order->created_at->format('Y M d h:m'),
                'reciever_name' => $order->reciever_name,
                'reciever_phone' => $order->reciever_phone,
                'reciever_city' => $order->reciever_city,
                'reciever_address' => $order->reciever_address,
                'sender_message' => $order->sender_message,
                'hidden' => $order->hidden,
                'wrapped' => $order->wrapped,
            ],
            'items' => $items,
        ]);
        return response($response,200);
    }

    private static function getItemPrice(OrderItems $orderItems, $option){
 
        switch($orderItems->Item->category_id){
            case 1:
                
                return $orderItems->Item->GiftCard->where('card_type', $option)->first()->card_price;
            
            case 2:
                return $orderItems->Item->IllustrationPrice->where('size',$option)->first()->price;

            case 3:
                return $orderItems->Item->Figurine->figure_price;

            case 4:
            case 5:
            case 6:
                $price = $orderItems->Item->GamePrices->where('platform_id', Platform::all()->where('name',$option)->first()->id)->first()->price;
                return $price;

            case 7:
                if($option == 'physical'){
                    return $orderItems->Item->Music->physical_price;
                }else{
                    return $orderItems->Item->Music->digital_price;
                }
        }
    }
}
