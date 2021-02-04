<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'email','menu_name','menu_category','menu_description','menu_price','quantity','user_id','menu_id','order_id','menu_image'
    ];
    protected $table = "orders"; 
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function menu_name()
    {
        return $this->belongsTo('App\Menu');
    }

    
}
