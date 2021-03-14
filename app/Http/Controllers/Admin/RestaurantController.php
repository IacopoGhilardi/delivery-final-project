<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', Auth::id())->get();

        return view('admin.deliverboo.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deliverboo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newRestaurant = new Restaurant();
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['business_name']);

        if (!empty($data["img_path"])) {
            $data["img_path"] = Storage::disk('public')->put('images', $data["img_path"]);
        }

        $newRestaurant->fill($data);
        $newRestaurant->save();
        
        return redirect()->route('admin.deliverboo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.deliverboo.show', ['restaurant' => Restaurant::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.deliverboo.edit', ['restaurant' => Restaurant::findOrFail($id)]);
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
        $data = $request->all();
        $restaurant = Restaurant::find($id);
        $restaurant->update($data);

        return redirect()->route('admin.deliverboo.index')->with('status', $restaurant->business_name .' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $restaurant = Restaurant::find($id);
        $restaurant->delete();

        return redirect()->route('admin.deliverboo.index')->with('status', $restaurant->business_name .' deleted!');
    }
}
