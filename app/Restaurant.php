<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'business_name',
        'address',
        'PIVA',
        'img_path'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    public function types() {
        return $this->belongsToMany('App\Type');
    }
}
