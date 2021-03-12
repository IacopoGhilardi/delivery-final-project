<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'ingredients',
        'price',
        'visibility',
        'dish_img_path'
    ];

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
