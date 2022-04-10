<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = User::where('is_artist', 1)->get();
        return view('admin.Artist.index',compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Artist.create');
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
            'select_box'=> 'required',
            'profileImage' => 'required'
        ]);
        $itemImage = time().preg_replace('/\s+/', '', $request->file('profileImage')->getClientOriginalName());
        $request->file('profileImage')->move(public_path('images/profile/'), $itemImage);

        $user = User::where('id', $request->select_box)->first();
        $user->is_artist = 1;
        $user->profile_image = $itemImage;
        $user->save();

        return redirect()->route('admin.artist.index')->with('success','Artist Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.Artist.edit',compact('user'));
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
        
        if($request->hasFile('profileImage')){
            $itemImage = time().preg_replace('/\s+/', '', $request->file('profileImage')->getClientOriginalName());
            $request->file('profileImage')->move(public_path('images/profile/'), $itemImage);

            $user = User::where('id', $request->select_box)->first();
            $user->profile_image = $itemImage;
            $user->save();

            return redirect()->route('admin.artist.index')->with('success','Artist Added Successfully');
        }else{
            return redirect()->route('admin.artist.edit',$id);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->is_artist = 0;
        $user->profile_image = null;
        $user->save();
        return redirect()->route('admin.artist.index')->with('success','Artist Removed Successfully');
    }
}
