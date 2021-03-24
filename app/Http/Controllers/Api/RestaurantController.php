<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Order;

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

    public function order($slug) {

        $restaurant = Restaurant::where('slug', $slug)->first();
        $dishes = $restaurant->dishes;
        $ordersUniqueIds = [];
        
        foreach ($dishes as $key => $dish) {
            $ordersIds[] = DB::table('dish_order')->select('order_id')->where('dish_id', $dish->id)->get();

            foreach ($ordersIds[$key] as $value) {
                if(!in_array($value, $ordersUniqueIds)) {
                    $ordersUniqueIds[] = $value;
                }
            }
        }
        $orders = [];
        foreach ($ordersUniqueIds as $value) {
           $orders[] = Order::where('id', $value->order_id)->first();
        }

        return response()->json($orders);
    }

}
