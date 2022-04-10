<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class ArtistDashboardAPIController extends Controller
{
    public function getTopSellingItem(Request $request){
        $item = DB::select('SELECT oi.item_id,i.item_image, oi.option, SUM(oi.quantity) "total_quantity", (oi.quantity*ip.price) "total_price" FROM `order_items` oi 
        JOIN `items` i ON oi.item_id = i.id 
        JOIN `illustration_prices` ip ON oi.item_id = ip.item_id AND oi.option = ip.size 
        JOIN `illustrations` ill ON oi.item_id=ill.id 
        WHERE ill.user_id = :user 
        GROUP BY oi.option,oi.item_id 
        ORDER BY (oi.quantity*ip.price) DESC LIMIT 1;', array('user' => auth()->user()->id));

        return response()->json([
            'item_id' => $item['0']->item_id,
            'item_image' => asset('images/items/'.$item['0']->item_image),
            'option' => $item['0']->option,
            'total_quantity' => $item['0']->total_quantity,
            'total_price' => $item['0']->total_price
        ]);
    }

    public function getTotalGeneratedIncome(Request $request){
        $total_generated_income = DB::select('SELECT SUM(oi.quantity*ip.price) "total_generated_income" FROM `order_items` oi 
        JOIN `items` i ON oi.item_id = i.id 
        JOIN `illustration_prices` ip ON oi.item_id = ip.item_id AND oi.option = ip.size 
        JOIN `illustrations` ill ON oi.item_id=ill.id 
        WHERE ill.user_id = :user;', array('user' => auth()->user()->id));

        return response()->json([
            'total_generated_income' => $total_generated_income['0']->total_generated_income
        ]);
    }

    public function getTotalSoldItems(Request $request){
        $total_sold_items = DB::select('SELECT COUNT(oi.item_id) "total_sold_items" FROM `order_items` oi 
        JOIN `items` i ON oi.item_id = i.id 
        JOIN `illustration_prices` ip ON oi.item_id = ip.item_id AND oi.option = ip.size 
        JOIN `illustrations` ill ON oi.item_id=ill.id 
        WHERE ill.user_id = :user;', array('user' => auth()->user()->id));

        return response()->json([
            'total_sold_items' => $total_sold_items['0']->total_sold_items
        ]);
    }

}
