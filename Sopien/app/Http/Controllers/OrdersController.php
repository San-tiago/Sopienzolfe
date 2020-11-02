<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\PlacedOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class OrdersController extends Controller
{
    //
    public function store(Request $request){

        $quantity = $request->input('quantity');
        $price = $request->input('menu_price');
        $total = $quantity * $price;
        $data = request([
            'user_name',
            'menu_name',
            'menu_category',
            'quantity',
            'menu_description',
        ]);
        $request->request->add(['menu_price'=>$total]);
        Order::create($request->all());
        return back();
    }

    public function view(){
        $user = Auth::user()->email;
        $orders = Order::where([
            'email'=>$user,
            'status'=> 0,
            ])->get();
        $total = Order::where([
            'email'=>$user,
            'status'=> 0,
            ])->sum('menu_price');
        return view('Order.order',compact('orders','total')); 
       
    }
    public function delete($id){
        $menu = Order::find($id);
        $menu -> delete();
        return back();
    }
    public function placeOrder(){
        $user = Auth::user()->email;
        Order::where('email', $user)->update(['status'=>1]);
        return back();
    }
}
