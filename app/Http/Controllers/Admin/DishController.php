<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Auth;
use App\Restaurant;

class DishController extends Controller
{

    public function index($slug) {

        $restaurant = Restaurant::where('slug', $slug)->first();

        return view('admin.menu.index', compact('restaurant'));
    }

    public function create($slug)
    {
        return view('admin.menu.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        $data = $request->all();
        $data['restaurant_id'] = $restaurant->id;
        $newDish = new Dish();

        $newDish->fill($data);
        $newDish->save();

        return redirect()->route('admin.menu.index', $restaurant->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.menu.show', 'restaurant');
    }
}
