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

    public function show($id) {
        $restaurant = Restaurant::where('id', $id)->first();

        return view('guest.restaurant.show', compact('restaurant'));
    }
}
