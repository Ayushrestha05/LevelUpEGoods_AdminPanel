<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::all();
        return view('admin.ads.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.create');
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/ads/'), $imageName);

        $ads = new Ads();
        $ads->title = $request->title;
        $ads->description = $request->description;
        $ads->image_url = $imageName;
        
        $ads->save();

        return redirect()->route('admin.ads.index')->with('success','Ad created successfully');
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
        $ad = Ads::where('id',$id)->first();
        return view('admin.ads.edit',compact('ad'));
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
            'title' => 'required',
            'description' => 'required',
            
        ]);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/ads/'), $imageName);
        }

        $ads = Ads::find($id);
        $ads->title = $request->title;
        $ads->description = $request->description;
        
        if($request->hasFile('image')){
            $ads->image_url = $imageName;
        }
        $ads->active = $request->active;
        
        $ads->save();

        return redirect()->route('admin.ads.index')->with('success','Ad updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ads::where('id',$id)->first();
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success','Ad deleted successfully');
    }
}
