<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Auth;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    private $dishValidation = [
        'name' => 'required|max:50',
        'ingredients' => 'required|max:500',
        'price' => 'required|numeric',
        'visibility' => 'required',
        'dish_img_path' => 'image'
    ];

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

        $request->validate($this->dishValidation);

        $data['restaurant_id'] = $restaurant->id;
        $newDish = new Dish();

        if (!empty($data["dish_img_path"])) {
            $data["dish_img_path"] = Storage::disk('public')->put('images', $data["dish_img_path"]);
        }

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
    // public function show($id)
    // {
        
    //     $restaurant = Restaurant::findOrFail($id);
    //     return view('admin.menu.show', 'restaurant');
    // }

    public function edit($id) { 
        $dish = Dish::findOrFail($id);
        return view('admin.menu.edit', compact('dish'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        $request->validate($this->dishValidation);

        $dish = Dish::find($id);

        if (!empty($data["dish_img_path"])) {
            Storage::disk('public')->delete($dish->dish_img_path);
            $data["dish_img_path"] = Storage::disk('public')->put('images', $data["dish_img_path"]);
        }


        // if(empty($data['dish_img_path'])) {
        //     $dish->dishes()->detach();
        // } else{
        //     $dish->dishes()->sync($data['dish_img_path']);
        // }

        $dish->update($data);

        $slug = $dish->restaurant->slug;
        return redirect()->route('admin.menu.index', compact('slug'))->with('status', $dish->name .' updated!');
    }

    public function destroy($id) {
        $dish = Dish::findOrFail($id);
        $name = $dish->name;
        $slug = $dish->restaurant->slug;
        $dish->delete();


        return redirect()->route('admin.menu.index', compact('slug'))->with('status', $name .' deleted successfully!');;
    }
}
