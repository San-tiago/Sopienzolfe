<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\PlacedOrder;
use App\ReceiverDetails;
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
            'status'=> ' ',
            ])->get();
        $total = Order::where([
            'email'=>$user,
            'status'=> ' ',
            ])->sum('menu_price');
        return view('Order.order',compact('orders','total')); 
       
    }
    public function delete($id){
        $menu = Order::find($id);
        $menu -> delete();
        return back();
    }
    public function placeOrder(Request $request){
        $user = Auth::user()->email;
        Order::where('email', $user)->update(['status'=>'Pending']);
      
        return view('Receiver.receiver');
    }
    public function receiver(Request $request){
          $data = request()->validate([
            'fromemail',
            'receivername' => 'required',
            'receiveraddress' => 'required',
            'receivercontactnumber' => 'required',
        ]);
        ReceiverDetails::create($request->all());
        return redirect('/home');
    }
    public function myorder(){
        $user = Auth::user()->email;
        $orders = Order::where([
            'email'=> $user,
            'status'=> 'Pending',
            ])->get();
         return view('Order.myorder',[
             'orders' => $orders,
         ]); 
        
     }
}
