<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSale;
use Illuminate\Http\Request;

class CheckoutSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkoutSales = CheckoutSale::all();
        return view('admin.sales.checkout-sale.index', compact('checkoutSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Sales.Checkout-Sale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sale_title' => 'required|string',
            'amount_required' => 'required|numeric',
            'discount_percent' => 'required|numeric',
            'active' => 'required|boolean',            
        ]);

        $checkoutSale = new CheckoutSale();
        $checkoutSale->sale_title = $request->sale_title;
        $checkoutSale->amount_required = $request->amount_required;
        $checkoutSale->discount_percent = $request->discount_percent;
        $checkoutSale->is_active = $request->active;
        $checkoutSale->save();

        return redirect()->route('admin.checkout.index')->with('success', 'Checkout Sale Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkoutSale = CheckoutSale::where('id', $id)->first();
        return view('admin.sales.checkout-sale.edit', compact('checkoutSale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sale_title' => 'required|string',
            'amount_required' => 'required|numeric',
            'discount_percent' => 'required|numeric',
            'active' => 'required|boolean',            
        ]);

        $checkoutSale = CheckoutSale::where('id', $id)->first();
        $checkoutSale->sale_title = $request->sale_title;
        $checkoutSale->amount_required = $request->amount_required;
        $checkoutSale->discount_percent = $request->discount_percent;
        $checkoutSale->is_active = $request->active;
        $checkoutSale->save();

        return redirect()->route('admin.checkout.index')->with('success', 'Checkout Sale Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = CheckoutSale::where('id', $id)->first();
        $sale->delete();

        return redirect()->route('admin.checkout.index')->with('success', 'Checkout Sale Deleted Successfully');
    }
}
