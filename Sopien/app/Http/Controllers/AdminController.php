<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Order;
class AdminController extends Controller
{
    //
    public function index(){
        return view ('layouts.dashboard');
    }

    public function menu(){
        $menus = Menu::orderBy('food_name')->get();
        return view('admin.menu',[
            'menus'=>$menus
            ]);

        
    }
    public function orders(){
        $users = User::where('provider_id','=', null)->get();
        return view ('admin.order',[
            'users' => $users,
        ]);
    }
    public function view_customerorders($email){
       $orders = Order::where([
           'email'=> $email,
           'status'=> 'Pending'
           ])->get();
        return view('admin.vieworders',[
            'orders' => $orders,
        ]); 
       
    }
    public function approveorder($id){
        Order::where('id', $id)->update(['status'=>'Ongoing']);
        return back();
    }
    public function receivedorder($id){
        Order::where('id', $id)->update(['status'=>'Received']);
        return back();
    }
    public function ongoingorders(){
       $ongoing_orders = Order::where([
            'status' => 'Ongoing'
            ])->get();
        return view('admin.ongoing_orders',compact('ongoing_orders'));
    }
    public function pendingorders(){
       $pending_orders = Order::where([
            'status' => 'Pending'
            ])->get();
        return view('admin.pending_orders',compact('pending_orders'));
    }
    public function receivedorders(){
       $received_orders = Order::where([
            'status' => 'Received'
            ])->get();
        return view('admin.received_orders',compact('received_orders'));
    }

    public function sales(){
        return view ('admin.sale');
    }
    public function users(){
        return view ('admin.user');
    }

}
