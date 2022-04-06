<?php

namespace App\Http\Controllers;

use App\Models\RewardItem;
use Illuminate\Http\Request;

class RewardItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reward_items = RewardItem::all();
        return view('admin.reward-items.index', compact('reward_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reward-items.create');
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
            'item_name' => 'required|string',
            'reward_points' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required',
        ]);

        $imageName = time().preg_replace('/\s+/', '', $request->name).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/reward-items/'), $imageName);

        $reward_item = new RewardItem(
            [
                'item_name' => $request->item_name,
                'reward_points' => $request->reward_points,
                'stock' => $request->stock,
                'item_image' => $imageName,
            ]
        );
        $reward_item->save();
        return redirect()->route('admin.reward-items.index')->with('success', 'Reward Item created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = RewardItem::where('id', $id)->first();
        return view('admin.reward-items.edit', compact('item'));
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
            'item_name' => 'required|string',
            'reward_points' => 'required|numeric',
            'stock' => 'required|numeric',
        
        ]);
        $reward_item = RewardItem::where('id', $id)->first();
        $reward_item->item_name = $request->item_name;
        $reward_item->reward_points = $request->reward_points;
        $reward_item->stock = $request->stock;
        if ($request->hasFile('image')) {
            $imageName = time().preg_replace('/\s+/', '', $request->name).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/reward-items/'), $imageName);
            $reward_item->item_image = $imageName;
        }
        $reward_item->save();

        return redirect()->route('admin.reward-items.index')->with('success', 'Reward Item updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward_item = RewardItem::where('id', $id)->first();
        $reward_item->delete();
        return redirect()->route('admin.reward-items.index')->with('success', 'Reward Item deleted successfully');
    }
}
