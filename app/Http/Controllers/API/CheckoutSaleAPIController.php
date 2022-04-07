<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CheckoutSale;
use Illuminate\Http\Request;

class CheckoutSaleAPIController extends Controller
{
    public function getCheckoutSale(){
        $checkoutSale = CheckoutSale::where('is_active', 1)->first();
        return response()->json($checkoutSale,200);
    }
}
