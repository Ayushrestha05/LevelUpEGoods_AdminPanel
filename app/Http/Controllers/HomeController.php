<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Platform;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome(){
        //new users this month
        $newUsers = User::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        //total reports
        $totalReports = Report::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        //total items sold
        $totalItemsSold = OrderItems::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('quantity');
        //total revenue
        $totalItems_Month = OrderItems::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
        $totalRevenue = 0;
        foreach($totalItems_Month as $item){
            $totalRevenue += ($item->quantity * $this->getItemPrice($item, $item->option));           
        }
        //top selling items
        $topSellingItems = DB::select('SELECT i.item_name, i.item_image,i.item_image,oi.option, COUNT(i.id) AS "sales" FROM `order_items`oi
        JOIN `items`i on i.id = oi.item_id
        GROUP BY oi.item_id, oi.option
        ORDER BY sales DESC
        LIMIT 5');
        return view('admin.home', compact('newUsers', 'totalReports', 'totalItemsSold','totalRevenue','topSellingItems'));
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
