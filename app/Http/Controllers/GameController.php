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
                    return redirect()->route('admin.games.index')->with('success','Game Added');
                }
                break;
                    
            case 'playstation':
                $i = 0;
                foreach($request->playstation as $item){
                    
                    if($item['price'] == null){
                        $i++;
                    }
                }
                
                if($i == count($request->playstation)){
                    return redirect()->route('admin.games.create')->withErrors(['error'=>'Please provide at least one of the prices']);
                }else{
                    //Copy Item Image to Storage
                    $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                    $request->image->move(public_path('images/items'), $itemImage);
                    //Create new Item object
                    $item = new Item([
                        'category_id' => 5,
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
                    
                    foreach($request->playstation as $item){
                        if($item['price'] != null){
                            $game = new Games([
                                'item_id' => $item_id,
                                'platform_id' => $item['platform'],
                                'price' => $item['price'],
                            ]);
                            $game->save();
                        }
                    }
                    return redirect()->route('admin.games.index')->with('success','Game Added');
                }
                break;
                        
            case 'switch':
                $i = 0;
                foreach($request->switch as $item){
                    
                    if($item['price'] == null){
                        $i++;
                    }
                }
                
                if($i == count($request->switch)){
                    return redirect()->route('admin.games.create')->withErrors(['error'=>'Please provide at least one of the prices']);
                }else{
                    //Copy Item Image to Storage
                    $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                    $request->image->move(public_path('images/items'), $itemImage);
                    //Create new Item object
                    $item = new Item([
                        'category_id' => 6,
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
                    
                    foreach($request->switch as $item){
                        if($item['price'] != null){
                            $game = new Games([
                                'item_id' => $item_id,
                                'platform_id' => $item['platform'],
                                'price' => $item['price'],
                            ]);
                            $game->save();
                        }
                    }
                    return redirect()->route('admin.games.index')->with('success','Game Added');
                }
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
        $item = Item::where('id',$id)->first();
        $game_description = GameDescription::where('item_id',$id)->first();
        $gameImages = explode( "|",GameDescription::where('item_id', $id)->first()->image_url);
        $platforms = Platform::all();
        return view('admin.games.show',compact('item','game_description','gameImages','platforms'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $item = Item::where('id',$id)->first();
        $game_platforms = Games::where('item_id',$id)->get();
        $game_description = GameDescription::where('item_id',$id)->first();
        $platforms = Platform::all();

        return view('admin.games.edit',compact('item','game_platforms','game_description', 'platforms'));
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
            'description' => 'required|string',
            'youtube' => 'required|string',
            'game_type' => 'required',
            'release_date' => 'required|date',
            
        ]);
        switch($request->game_type){
            
            case 'upcoming':
                //Copy Item Image to Storage
                if($request->image != null){
                    $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                    $request->image->move(public_path('images/items'), $itemImage);
                }

                $item = Item::where('id',$id)->first();
                $item->item_name = $request->name;
                $item->item_description = $request->description;
                if($request->image != null){
                    $item->item_image = $itemImage;
                }
                $item->save();
                
                if($request->file('gamesImage') != null){
                    $imageFiles = [];    
                    //Upload the images and save names into database
                    foreach($request->file('gamesImage') as $file){
                        $imageName = time().$file->getClientOriginalName();
                        $file->move(public_path('images/games'), $imageName);
                        $imageFiles[] = $imageName;
                    }
                }
                
                $game_description = GameDescription::where('item_id', $item->id)->first();
                $game_description->release_date = $request->release_date;
                $game_description->trailer_url = $request->youtube;
                if($request->file('gamesImage') != null){
                    $game_description->image_url = implode('|', $imageFiles);
                }
                $game_description->save();

                return redirect()->route('admin.games.index')->with('success','Game Updated');
                break;
                
            case 'released':
                $i = 0;
                foreach($request->released as $item){
                    
                    if($item['price'] == null){
                        $i++;
                    }
                }
                
                if($i == count($request->released)){
                    return redirect()->route('admin.games.create')->withErrors(['error'=>'Please provide at least one of the prices']);
                }else{
                    if($request->image != null){
                        $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                        $request->image->move(public_path('images/items'), $itemImage);
                    }

                    $item = Item::where('id',$id)->first();
                    $item_id = $item->id;
                    $item->item_name = $request->name;
                    $item->item_description = $request->description;
                    $item->category_id = 4;
                    if($request->image != null){
                        $item->item_image = $itemImage;
                    }
                    $item->save();
                    
                    if($request->file('gamesImage') != null){
                        $imageFiles = [];    
                        //Upload the images and save names into database
                        foreach($request->file('gamesImage') as $file){
                            $imageName = time().$file->getClientOriginalName();
                            $file->move(public_path('images/games'), $imageName);
                            $imageFiles[] = $imageName;
                        }
                    }
                    
                    $game_description = GameDescription::where('item_id', $item->id)->first();
                    $game_description->release_date = $request->release_date;
                    $game_description->trailer_url = $request->youtube;
                    if($request->file('gamesImage') != null){
                        $game_description->image_url = implode('|', $imageFiles);
                    }
                    $game_description->save();
                    
                    foreach($request->released as $item){
                        if($item['price'] != null){
                            Games::updateOrCreate(
                                ['item_id' => $item_id, 'platform_id' => $item['platform']],
                                ['price' => $item['price']]
                            );
                        }else{
                            Games::where('item_id', $item_id)->where('platform_id', $item['platform'])->delete();
                        }
                    }
                    if($request->game_type == 'playstation'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            if($game->Platform->platform_family != 'playstation'){
                                $game->delete();
                            }
                        }
                    }
                    if($request->game_type == 'switch'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            if($game->Platform->platform_family != 'switch'){
                                $game->delete();
                            }
                        }
                    }

                    if($request->game_type == 'upcoming'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            $game->delete();
                        }
                    }
                    return redirect()->route('admin.games.index')->with('success','Game Updated');
                }
                break;
                    
            case 'playstation':
                $i = 0;
                foreach($request->playstation as $item){
                    
                    if($item['price'] == null){
                        $i++;
                    }
                }
                
                if($i == count($request->playstation)){
                    return redirect()->route('admin.games.edit',$id)->withErrors(['error'=>'Please provide at least one of the prices']);
                }else{
                    if($request->image != null){
                        $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                        $request->image->move(public_path('images/items'), $itemImage);
                    }

                    $item = Item::where('id',$id)->first();
                    $item_id = $item->id;
                    $item->item_name = $request->name;
                    $item->item_description = $request->description;
                    $item->category_id = 5;
                    if($request->image != null){
                        $item->item_image = $itemImage;
                    }
                    $item->save();
                    
                    if($request->file('gamesImage') != null){
                        $imageFiles = [];    
                        //Upload the images and save names into database
                        foreach($request->file('gamesImage') as $file){
                            $imageName = time().$file->getClientOriginalName();
                            $file->move(public_path('images/games'), $imageName);
                            $imageFiles[] = $imageName;
                        }
                    }
                    
                    $game_description = GameDescription::where('item_id', $item->id)->first();
                    $game_description->release_date = $request->release_date;
                    $game_description->trailer_url = $request->youtube;
                    if($request->file('gamesImage') != null){
                        $game_description->image_url = implode('|', $imageFiles);
                    }
                    $game_description->save();
                    
                    foreach($request->playstation as $item){
                        if($item['price'] != null){
                            Games::updateOrCreate(
                                ['item_id' => $item_id, 'platform_id' => $item['platform']],
                                ['price' => $item['price']]
                            );
                        }else{
                            Games::where('item_id', $item_id)->where('platform_id', $item['platform'])->delete();
                        }
                    }
                    if($request->game_type == 'playstation'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            if($game->Platform->platform_family != 'playstation'){
                                $game->delete();
                            }
                        }
                    }
                    if($request->game_type == 'switch'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            if($game->Platform->platform_family != 'switch'){
                                $game->delete();
                            }
                        }
                    }

                    if($request->game_type == 'upcoming'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            $game->delete();
                        }
                    }
                    return redirect()->route('admin.games.index')->with('success','Game Updated');
                }
                break;
                        
            case 'switch':
                $i = 0;
                foreach($request->switch as $item){
                    
                    if($item['price'] == null){
                        $i++;
                    }
                }
                
                if($i == count($request->switch)){
                    return redirect()->route('admin.games.create')->withErrors(['error'=>'Please provide at least one of the prices']);
                }else{
                    if($request->image != null){
                        $itemImage = time().preg_replace('/\s+/', '', $request->image->getClientOriginalName());
                        $request->image->move(public_path('images/items'), $itemImage);
                    }

                    $item = Item::where('id',$id)->first();
                    $item_id = $item->id;
                    $item->item_name = $request->name;
                    $item->item_description = $request->description;
                    $item->category_id = 6;
                    if($request->image != null){
                        $item->item_image = $itemImage;
                    }
                    $item->save();
                    
                    if($request->file('gamesImage') != null){
                        $imageFiles = [];    
                        //Upload the images and save names into database
                        foreach($request->file('gamesImage') as $file){
                            $imageName = time().$file->getClientOriginalName();
                            $file->move(public_path('images/games'), $imageName);
                            $imageFiles[] = $imageName;
                        }
                    }
                    
                    $game_description = GameDescription::where('item_id', $item->id)->first();
                    $game_description->release_date = $request->release_date;
                    $game_description->trailer_url = $request->youtube;
                    if($request->file('gamesImage') != null){
                        $game_description->image_url = implode('|', $imageFiles);
                    }
                    $game_description->save();
                    
                    foreach($request->switch as $item){
                        if($item['price'] != null){
                            Games::updateOrCreate(
                                ['item_id' => $item_id, 'platform_id' => $item['platform']],
                                ['price' => $item['price']]
                            );
                        }else{
                            Games::where('item_id', $item_id)->where('platform_id', $item['platform'])->delete();
                        }
                    }
                    if($request->game_type == 'playstation'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            if($game->Platform->platform_family != 'playstation'){
                                $game->delete();
                            }
                        }
                    }
                    if($request->game_type == 'switch'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            if($game->Platform->platform_family != 'switch'){
                                $game->delete();
                            }
                        }
                    }

                    if($request->game_type == 'upcoming'){
                        foreach(Games::where('item_id',$id)->get() as $game){
                            $game->delete();
                        }
                    }
                    return redirect()->route('admin.games.index')->with('success','Game Updated');
                }
                break;
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
        Item::destroy($id);
        return redirect()->route('admin.games.index')->with('success', 'Item deleted successfully');
    }
    


    
}
