<?php

namespace App\Http\Controllers;

use App\Models\RewardHistory;
use Illuminate\Http\Request;

class RewardHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reward_history = RewardHistory::all();
        return view('admin.Reward-History.index',compact('reward_history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reward_history = RewardHistory::where('id',$id)->first();
        return view('admin.Reward-History.edit',compact('reward_history'));
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
        $reward_history = RewardHistory::where('id',$id)->first();
        $reward_history->update($request->all());
        return redirect()->route('admin.reward-history.index')->with('success','Reward History updated successfully');
    }

}
