<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Type;
use App\Dish;
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

    public function dish($slug) {

        $restaurant = Restaurant::where('slug', $slug)->first();
        $dishes = $restaurant->dishes;
        $ordersUniqueIds = [];
        
        
            $ordersIds[] = DB::table('dish_order')->select('dish_id')->selectRaw('"dish_id", count("dish_id")')->from('dish_order')->groupBy('dish_id')->orderBy('count("dish_id")', 'DESC')->take(1)->get();
           // DB::table('dish_order')->select('dish_id')->count('dish_id')->from('dish_order')->groupBy('dish_id')->get();
            
            /*
            foreach ($ordersIds as $ordersId) {
                if(!in_array($ordersId, $ordersUniqueIds)) {
                    $ordersUniqueIds[] = $ordersId;
                }
            }*/
            /*
            $arr = [];
            for ($x = 0; $x <= count($ordersIds); $x++) {
                if(count($ordersIds[$x]) < count($ordersIds[$x++])){
                    $arr[] = $ordersIds[$x++];
                }
            }
            */
            
            /*
            $arr = [];
            $i = 0;
            while ($i < count($ordersIds)){
                if($ordersIds[$i] < $ordersIds[$i+1]){
                    $arr[] = $ordersIds[$i+1];
                }
    
                $i++;
            } 
            */    
        

        
      
        
        $orders = [];
        foreach ($ordersIds as $orderid) {
           $orders[] = $orderid[0];
        }
        
        $order = $orders[0];

        return response()->json($order);
    }

}
