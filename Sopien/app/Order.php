<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'email','menu_name','menu_category','menu_description','menu_price','quantity','user_id','menu_id'
    ];
    protected $table = "orders";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function menu_name()
    {
        return $this->belongsTo('App\Menu');
    }

    
}
