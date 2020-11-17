<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'email','menu_name','menu_category','menu_description','menu_price','quantity','user_id'
    ];
    protected $table = "orders";
    public function users()
    {
        return $this->hasMany('App\User','id','user_id');
    }

    
}
