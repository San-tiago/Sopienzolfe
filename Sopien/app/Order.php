<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_name','menu_name','menu_category','menu_description','menu_price',
    ];
}
