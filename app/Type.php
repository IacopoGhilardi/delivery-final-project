<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{   
    public $timestamps = false;

    protected $fillable = [
        'name',
        'img_path'
    ];

    public function restaurants() {
        return $this->BelongsToMany('App\Restaurant');
    }
}
