<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Type;

class GuestController extends Controller
{
    //
    public function index() {

        $types = Type::all();

        return view('guest.homepage', compact('types'));
    }

    public function show(Request $request) {
        $data = $request->all();
        $restaurant = Restaurant::where('business_name', $data["business_name"])->first();
        return view('guest.restaurant.show', compact('restaurant'));
    }
}
