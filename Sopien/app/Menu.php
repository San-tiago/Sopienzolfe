<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'food_name','menu_category','description','price','image'
    ];

    public function menu()
    {
        return $this->hasMany('App\Order');
    }
}
