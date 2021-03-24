<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'status',
        'total_amount',
        'date'
    ];

    public function dishes() {
        return $this->belongsToMany('App\Dish');
    }
}
