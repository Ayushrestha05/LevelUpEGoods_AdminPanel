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
            'figurineHeight' => 'required_if:figurineDimension,==,null',
            'figurineDimension' => 'required_if:figurineHeight,==,null',
            'figurinePrice' => 'required|numeric',
            'figurineImage' => 'required',
        ]);

        $itemImage = time().preg_replace('/\s+/', '', $request->figurineImage->getClientOriginalName());
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
            'figure_dimension' => $request->figurineDimension,
            'figure_price' => $request->figurinePrice,
            'figure_description' => $request->figurineDescription,
        ]);

        $figurine->save();

        $image = [];
        //Seperating Words from the Name of the Figurine
        $name = explode(" ",$request->figurineName);
        $i = 0;
        //Upload the images and save names into database
        foreach($request->file('figurineImageFile') as $file){
            ++$i;
            //Add Time, Remove Special Characters from Name and Add Extension for a new File Name
            $imageName = time().preg_replace('/[^A-Za-z0-9\-]/', '', $name[0]).$i.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/figurines'), $imageName);
            $image[] = $imageName;
            
        }

        $figurineImage = new FigurineImages([
            'item_id' => $item_id,
            'image_path' => implode('|', $image),
        ]);

        $figurineImage->save();

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
        $item = Item::where('id', $id)->first();
        $figurine = Figurine::where('item_id', $id)->first();
        $figurineImages = explode( "|",FigurineImages::where('item_id', $id)->first()->image_path);
        
        return view('admin.figurines.show', compact('item', 'figurine', 'figurineImages'));
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
        $figurine = Figurine::where('item_id', $id)->first();
        $figurineImages = FigurineImages::where('item_id', $id)->first()->image_path;
        return view('admin.figurines.update', compact('item', 'figurine','figurineImages'));
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
            'figurineName' => 'required|string',
            'figurineDescription' => 'required|string',
            'figurineHeight' => 'required_if:figurineDimension,==,null',
            'figurineDimension' => 'required_if:figurineHeight,==,null',
            'figurinePrice' => 'required|numeric',
        ]);

        if($request->figurineImage != null){
            $itemImage = time().preg_replace('/\s+/', '', $request->figurineImage->getClientOriginalName());
            $request->figurineImage->move(public_path('images/items'), $itemImage);
        }

        $item = Item::where('id', $id)->first();
        $item->item_name = $request->figurineName;
        if($request->figurineImage != null){
            $item->item_image = $itemImage;
        }
        $item->save();
        
        $figurine = Figurine::where('item_id', $id)->first();
        $figurine->figure_height = $request->figurineHeight;
        $figurine->figure_dimension = $request->figurineDimension;
        $figurine->figure_price = $request->figurinePrice;
        $figurine->figure_description = $request->figurineDescription;
        $figurine->save();

        if($request->file('figurineImageFile') != null){
            $image = [];
            //Seperating Words from the Name of the Figurine
            $name = explode(" ",$request->figurineName);
            $i = 0;
            //Upload the images and save names into database
            foreach($request->file('figurineImageFile') as $file){
                ++$i;
                //Add Time, Remove Special Characters from Name and Add Extension for a new File Name
                $imageName = time().preg_replace('/[^A-Za-z0-9\-]/', '', $name[0]).$i.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/figurines'), $imageName);
                $image[] = $imageName;
                
            }
            $figurineImage = FigurineImages::where('item_id', $id)->first();
            $figurineImage->image_path = implode('|', $image);
            $figurineImage->save();
        }
        
        

        return redirect()->route('admin.figurine.index')->with('success', 'Figurine Updated successfully');
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
        return redirect()->route('admin.figurine.index')->with('success', 'Figurine Deleted successfully');
    }
}
