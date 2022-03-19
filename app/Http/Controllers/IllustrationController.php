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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
