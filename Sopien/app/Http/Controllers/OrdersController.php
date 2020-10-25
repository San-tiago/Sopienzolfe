<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class OrdersController extends Controller
{
    //
    public function store(Request $request){
        $data = request([
            'user_name',
            'menu_name',
            'menu_category',
            'menu_description',
            'menu_price',
        ]);
        Order::create($request->all());
        return redirect('/home');
    }

    public function view(){
        $user = Auth::user()->name;
        $orders = Order::where('user_name',$user)->get();
        return view('Order.order',[
            'orders'=>$orders
            ]); 
       
    }
}
