<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Type;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //
    public function index($type) {
        $typeObj = Type::where('name', $type)->first();
        $restaurants = $typeObj->restaurants;

        foreach ($restaurants as $restaurant) {
            $restaurant->types;
        }
        
        return response()->json($restaurants);
    }

    public function allRestaurants() {
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            $restaurant->types;
        }

        // dd($restaurants);
        return response()->json($restaurants);
    }
    
}
