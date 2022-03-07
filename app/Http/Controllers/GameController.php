<?php

namespace App\Http\Controllers;

use App\Models\GameDescription;
use App\Models\Games;
use App\Models\Item;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $items = Item::where(function ($query) {
            $query->where('category_id', '=', 4)->orWhere('category_id', '=', 5)->orWhere('category_id', '=', 6)->get();
        })->get();
        return view('admin.games.index', compact('items'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $platforms = Platform::all();
        
        return view('admin.games.create',compact('platforms'));
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
            'youtube' => 'required|string',
            'game_type' => 'required',
            'release_date' => 'required|date',
            'image' => 'required',
            'gamesImage' => 'required',
        ]);
        switch($request->game_type){
            
            case 'upcoming':
                //Copy Item Image to Storage
                $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                $request->image->move(public_path('images/items'), $itemImage);
                //Create new Item object
                $item = new Item([
                    'category_id' => 4,
                    'item_name' => $request->name,
                    'item_description' => $request->description,
                    'item_image'=> $itemImage,
                ]);
                //Save Item Object
                $item->save();
                $item_id = $item->id;
                
                $imageFiles = [];    
                //Upload the images and save names into database
                foreach($request->file('gamesImage') as $file){
                    $imageName = time().$file->getClientOriginalName();
                    $file->move(public_path('images/games'), $imageName);
                    $imageFiles[] = $imageName;
                }
                
                //Create a ne object to store Game Descriptions
                $game_description = new GameDescription([
                    'item_id' => $item_id,
                    'release_date' => $request->release_date,
                    'trailer_url' => $request->youtube,
                    'image_url' => implode('|', $imageFiles),
                ]);
                
                $game_description->save();
                return redirect()->route('admin.games.index')->with('success','Game Added');
                break;
                
            case 'released':
                $this->addGame($request,4);
                break;
                    
            case 'playstation':
                $this->addGame($request,5);
                break;
                        
            case 'switch':
                $this->addGame($request,6);
                break;
        }
                        
                        
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
        Item::destroy($id);
        return redirect()->route('admin.games.index')->with('success', 'Item deleted successfully');
    }
    
    public function addGame(Request $request, int $category_id){
        $i = 0;
        foreach($request->released as $item){
            
            if($item['price'] == null){
                $i++;
            }
        }
        
        if($i == count($request->released)){
            return redirect()->route('admin.games.create')->withErrors(['error'=>'Please provide at least one of the prices']);
        }else{
            //Copy Item Image to Storage
            $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
            $request->image->move(public_path('images/items'), $itemImage);
            //Create new Item object
            $item = new Item([
                'category_id' => $category_id,
                'item_name' => $request->name,
                'item_description' => $request->description,
                'item_image'=> $itemImage,
            ]);
            //Save Item Object
            $item->save();
            $item_id = $item->id;
            
            $imageFiles = [];    
            //Upload the images and save names into database
            foreach($request->file('gamesImage') as $file){
                $imageName = time().$file->getClientOriginalName();
                $file->move(public_path('images/games'), $imageName);
                $imageFiles[] = $imageName;
            }
            
            //Create a ne object to store Game Descriptions
            $game_description = new GameDescription([
                'item_id' => $item_id,
                'release_date' => $request->release_date,
                'trailer_url' => $request->youtube,
                'image_url' => implode('|', $imageFiles),
            ]);
            
            $game_description->save();
            
            foreach($request->released as $item){
                if($item['price'] != null){
                    $game = new Games([
                        'item_id' => $item_id,
                        'platform_id' => $item['platform'],
                        'price' => $item['price'],
                    ]);
                    $game->save();
                }
            }
            redirect()->route('admin.games.index')->with('success','Game Added');
        }
    }
}
