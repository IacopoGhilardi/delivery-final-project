<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class GuestController extends Controller
{
    //
    public function index() {

        $types = Type::all();

        return view('guest.homepage', compact('types'));
    }
}
