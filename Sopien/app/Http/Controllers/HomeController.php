<?php

namespace App\Http\Controllers;
use App\Menu;
use App\User;
use App\Order;
use App\Category;
use App\ReceiverDetails;
use Auth;
use DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   //

        $users = User::all();
        $menus = Menu::orderBy('food_name')->get();
        $categories = Category::orderBy('category')->get();
        echo $check = DB::table('receiver_details')
                ->where([
                    'fromemail' => Auth::user()->email,
                    'transac_status' => 0
                    ])
                ->latest()
                ->get();
        return view('home',compact('menus','categories','users','check'));
    
    }

    public function menu_nav($category){
        $users = User::all();
        $menus = Menu::where('menu_category',$category)->get();
        $categories = Category::orderBy('category')->get();
        return view('home',compact('menus','categories','users'));
    }

    public function orderHistory($email){
        $order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 1
            ])->get();
        return view('Order.orderhistory',compact('order_history'));
    }
    public function view_orderHistory($id){
        $orders= Order::where([
            'order_id' => $id,
            'status' => 'Received'
            ])->get();
        $total= Order::where([
            'order_id' => $id,
            'status' => 'Received'
            ])->sum('menu_price');
        return view('Order.view_historyorder',compact('orders','total'));
    }
}
