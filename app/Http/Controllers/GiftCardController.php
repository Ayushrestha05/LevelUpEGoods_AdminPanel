<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\Item;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gift_cards = Item::all()->where('category_id', 1);
        return view('admin.Gift-Cards.index',compact('gift_cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Gift-Cards.create');
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
            'description_text' => 'required|string',
            'image' => 'required',
            'card.*.type' => 'required|string',
            'card.*.price' => 'required|numeric',
        ]);

        $imageName = time().preg_replace('/\s+/', '', $request->name).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/items'), $imageName);

        $item = new Item([
            'category_id' => 1,
            'item_name' => $request->name,
            'item_description' => $request->description_text,
            'item_image' => $imageName,
        ]);

        $item->save();
        $addedItemID = Item::all()->last()->id;

        foreach($request->card as $cardItem) {
            $cardObject = new GiftCard([
                'item_id' => $addedItemID,
                'card_type' => $cardItem['type'],
                'card_price' => $cardItem['price'],
            ]);
            $cardObject->save();
        }

        return redirect()->route('admin.gift-card.index')->with('success', 'Gift Card Added successfully');

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
        $gift_card = GiftCard::where('item_id', $id)->get();
        return view('admin.Gift-Cards.show',compact('item','gift_card'));
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
        $gift_card = GiftCard::where('item_id', $id)->get();
        return view('admin.Gift-Cards.edit',compact('item','gift_card'));
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
            'description_text' => 'required|string',
            'card.*.type' => 'required|string',
            
        ]);

        if($request->image != null){
            $imageName = time().preg_replace('/\s+/', '', $request->name).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/items'), $imageName);
        }

        $item = Item::where('id', $id)->first();
        $item->item_name = $request->name;
        $item->item_description = $request->description_text;
        if($request->image != null){
            $item->item_image = $imageName;
        }
        $item->save();
        

        foreach($request->card as $cardItem) {
            // $cardObject = new GiftCard([
            //     'item_id' => $item->id,
            //     'card_type' => $cardItem['type'],
            //     'card_price' => $cardItem['price'],
            // ]);
            // $cardObject->save();
            if($cardItem['price'] == ''){
                GiftCard::where('item_id', $item->id)->where('card_type', $cardItem['type'])->delete();
            }else{
                GiftCard::updateOrCreate(
                    ['item_id' => $item->id, 'card_type' => $cardItem['type']],
                    ['card_price' => $cardItem['price']]
                );
            }
            
        }

        return redirect()->route('admin.gift-card.index')->with('success', 'Gift Card Updated successfully');
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
        return redirect()->route('admin.gift-card.index')->with('success', 'Gift Card Deleted successfully');
    }
}
