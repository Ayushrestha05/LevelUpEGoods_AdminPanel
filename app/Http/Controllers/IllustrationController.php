<?php

namespace App\Http\Controllers;

use App\Models\Illustration;
use App\Models\IllustrationPrice;
use App\Models\Item;
use Illuminate\Http\Request;

class IllustrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $illustrations = Item::all()->where('category_id', '2');
        return view('admin.illustrations.index',compact('illustrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.illustrations.create');
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
            'name' => 'required|string',
            'description' => 'required|string',
            'select_box' => 'required_if:name_creator,==,null',
            'name_creator' => 'required_if:select_box,==,null',
            'image' => 'required',
            'illustration.*.size' => 'required',
            'illustration.*.price' => 'required',
        ]);

        $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
        $request->image->move(public_path('images/items/'), $itemImage);

        $item = new Item([
            'category_id' => 2,
            'item_name' => $request->name,
            'item_description' => $request->description,
            'item_image' => $itemImage,
        ]);

        $item->save();

        $item_id = Item::all()->last()->id;

        $illustration_item = new Illustration([
            'description' => $request->description,
            'item_id' => $item_id,
            'user_id' => $request->select_box,
            'creator' => $request->name_creator,
        ]);

        $illustration_item->save();

        foreach($request->illustration as $value){
            $value_item = new IllustrationPrice([
                'size' => $value['size'],
                'price' => $value['price'],
                'item_id' => $item_id,
            ]);

            $value_item->save();
        }

        return redirect()->route('admin.illustrations.index')->with('success', 'Figurine Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::where('id', $id)->first();
        $illustrations = Illustration::where('item_id', $id)->get();
        $illustration_prices = IllustrationPrice::where('item_id', $id)->get();
        return view('admin.illustrations.show', compact('item', 'illustrations', 'illustration_prices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::where('id', $id)->first();
        $illustrations = Illustration::where('item_id', $id)->first();
        $illustration_prices = IllustrationPrice::where('item_id', $id)->get();
        return view('admin.illustrations.edit', compact('item', 'illustrations', 'illustration_prices'));
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
            'name' => 'required|string',
            'description' => 'required|string',
            'illustration.*.size' => 'required',
        ]);

        if($request->image != null){
            $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
            $request->image->move(public_path('images/items/'), $itemImage);
        }

        $item = Item::where('id', $id)->first();
        $item->item_name = $request->name;
        $item->item_description = $request->description;
        if($request->image != null){
            $item->item_image = $itemImage;
        }
        $item->save();
        
        $illustration = Illustration::where('item_id', $id)->first();
        $illustration->description = $request->description;   
        $illustration->save();

        foreach($request->illustration as $value){
            // $value_item = new IllustrationPrice([
            //     'size' => $value['size'],
            //     'price' => $value['price'],
            //     'item_id' => $item_id,
            // ]);

            // $value_item->save();
            if($value['price'] == ''){
                
            }else{
                IllustrationPrice::updateOrCreate(
                    ['item_id' => $id, 'size' => $value['size']],
                    ['price' => $value['price']]
                );
            }
        }

        return redirect()->route('admin.illustrations.index')->with('success', 'Figurine Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::where('id', $id)->first();
        $item->delete();

        return redirect()->route('admin.illustrations.index')->with('success', 'Figurine Deleted successfully');
    }
}
