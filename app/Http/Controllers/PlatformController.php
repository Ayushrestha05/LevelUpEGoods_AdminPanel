<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.platform.index',compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.platform.create');
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
            'icon' => 'required|mimes:svg',
            'family' => 'required',
        ]);

        $imageName = time().'-'.$request->file('icon')->getClientOriginalName();
        $request->file('icon')->move(public_path('images/platforms'), $imageName);

        $platform = new Platform([
            'name' => $request->get('name'),
            'icon_filename' => $imageName,
            'platform_family' => $request->get('family'),
        ]);

        $platform->save();

        return redirect()->route('admin.platforms.index')->with('success', 'Platform created successfully');
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
        Platform::destroy($id);
        return redirect()->route('admin.platforms.index')->with('success', 'Platform deleted successfully');
    }
}
