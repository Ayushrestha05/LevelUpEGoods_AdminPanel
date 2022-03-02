<?php

namespace App\Http\Controllers;

use App\Models\Figurine;
use App\Models\FigurineImages;
use App\Models\Item;
use Illuminate\Http\Request;

class FigurineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $figurines = Item::all()->where('category_id', '3');
        return view('admin.figurines.index', compact('figurines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.figurines.create');
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
            'figurineName' => 'required|string',
            'figurineDescription' => 'required|string',
            'figurineHeight' => 'required|string',
            'figurinePrice' => 'required|numeric',
            'figurine.*.file' => 'required|max:2048',
        ]);

        $itemImage = time().preg_replace('/\s+/', '', $request->figurineImage->getClientOriginalName()).'.'.$request->figurineImage->getClientOriginalExtension();
        $request->figurineImage->move(public_path('images/items'), $itemImage);

        //Create a new Item
        $item = new Item([
            'category_id' => 3,
            'item_name' => $request->figurineName,
            'item_image' => $itemImage,
        ]);

        $item->save();
        $item_id = Item::all()->last()->id;

        //Create a new Figurine
        $figurine = new Figurine([
            'item_id' => $item_id,
            'figure_height' => $request->figurineHeight,
            'figure_price' => $request->figurinePrice,
            'figure_description' => $request->figurineDescription,
        ]);

        $figurine->save();

        //Upload the images and save names into database
        foreach($request->figurine as $image){
            $imageName = time().preg_replace('/\s+/', '', $image['file']->getClientOriginalName()).'.'.$image['file']->getClientOriginalExtension();
            $image['file']->move(public_path('images/figurines'), $imageName);
            
            $figurineImage = new FigurineImages([
                'item_id' => $item_id,
                'image_path' => $imageName,
            ]);

            $figurineImage->save();
        }

        return redirect()->route('admin.figurine.index')->with('success', 'Figurine Added successfully');


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
