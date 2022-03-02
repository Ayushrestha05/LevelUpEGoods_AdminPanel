<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Music;
use App\Models\MusicTrack;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $music_items = Item::all()->where('category_id', 7);
        
        return view('admin.music.index', compact('music_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.music.new_music');
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
            'album_name' => 'required|string',
            'album_artist' => 'required|string',
            'album_type' => 'required|string',
            'album_image' => 'required',
            'digital_price' => 'numeric',
            'physical_price' => 'numeric',
            'album.*.name' => 'required|string',
            'album.*.time' => 'required|string',
            'album.*.file' => 'required',
        ]);

        $albumImageName = time().preg_replace('/\s+/', '', $request->album_name).'.'.$request->album_image->getClientOriginalExtension();
        $request->album_image->move(public_path('images/items'), $albumImageName);
        
        //Adding Data to Item Table
        $item = new Item;
        $item->category_id = 7;
        $item->item_name = $request->album_name;
        $item->item_description = $request->album_artist;
        $item->item_image = $albumImageName;
        $item->save();
        //Getting the latest Item ID
        $addedItemID = Item::all()->last()->id;

        

        //Adding Data to Music Table
        $music = new Music;
        $music->item_id = $addedItemID;
        $music->music_type = $request->album_type;
        $music->digital_price = $request->digital_price;
        $music->physical_price = $request->physical_price;
        $music->save();

        //Adding Data to Music_Tracks
        foreach($request->album as $album) {
            $trackFileName = time().preg_replace('/\s+/', '', $album['name']).'.'.$album['file']->getClientOriginalExtension();
            $album['file']->move(public_path('music/'), $trackFileName);

            $musicTrack = new MusicTrack;
            $musicTrack->item_id = $addedItemID;
            $musicTrack->track_name = $album['name'];
            $musicTrack->track_time = $album['time'];
            $musicTrack->track_file = $trackFileName;
            $musicTrack->save();
        }

        return redirect()->route('admin.music.index')->with('success', 'Music Added successfully');
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
        $item = Item::where('id',$id)->first();
        $item->delete();
        
        return redirect()->route('admin.music.index')->with('success', 'Music Deleted Successfully');
    }
}
