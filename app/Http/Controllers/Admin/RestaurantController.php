<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Type;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    private $restaurantValidation = [
        'business_name' => 'required|max:50',
        'address' => 'required|max:50',
        'PIVA' => 'required|string|max:11|min:11',
        'img_path' => 'image'
    ];
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
        $types = Type::all();
        return view('admin.deliverboo.create', compact('types'));
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
        
        //@dd($data );

        $request->validate($this->restaurantValidation);
        //@dd($data );

        $newRestaurant = new Restaurant();
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['business_name']);

        if (!empty($data["img_path"])) {
            $data["img_path"] = Storage::disk('public')->put('images', $data["img_path"]);
        }

        $newRestaurant->fill($data);
        $newRestaurant->save();

        if(!empty($data["types"])) {
            $newRestaurant->types()->attach($data["types"]);
        };
        
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
        $restaurant = Restaurant::findOrFail($id);
        $types = Type::all();

        return view('admin.deliverboo.edit', compact('restaurant', 'types'));
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
        // @dd($data);
        $request->validate($this->restaurantValidation);

        $restaurant = Restaurant::find($id);

        if (!empty($data["img_path"])) {
            Storage::disk('public')->delete($restaurant->img_path);
            $data["img_path"] = Storage::disk('public')->put('images', $data["img_path"]);
        }

        $restaurant->update($data);

        if (empty($data['types'])) {
            $restaurant->types()->detach($data['types']);
        } else {
            $restaurant->types()->sync($data['types']);
        }

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
        Storage::disk('public')->delete($restaurant->img_path);
        $restaurant->delete();

        return redirect()->route('admin.deliverboo.index')->with('status', $restaurant->business_name .' deleted!');
    }
}
