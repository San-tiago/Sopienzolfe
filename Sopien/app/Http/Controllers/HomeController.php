<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
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
        $menus_count = count($menus);
        $categories = Category::orderBy('category')->get();
        /* $check = DB::table('receiver_details')
                ->where([
                    'fromemail' => Auth::user()->email,
                    ])
                ->latest()
                ->get(); */
        $new_transac = ReceiverDetails::where('fromemail',Auth::user()->email)->max('id');
          /*  $new_transac = DB::table('receiver_details')->where(
                            'id' => \DB::raw("(select max(`id`) from receiver_details)"),
                            'fromemail' => Auth::user()->email
                            )->get(); */
                
        return view('home',compact('menus','categories','users','new_transac','menus_count'));
    
    }

    public function menu_nav($category){
        $users = User::all();
        $menus = Menu::where('menu_category',$category)->get();
        $menus_count = count($menus);
        $categories = Category::orderBy('category')->get();
        $check = DB::table('receiver_details')
        ->where([
            'fromemail' => Auth::user()->email,
            'transac_status' => 0
            ])
        ->latest()
        ->get();
        return view('home',compact('menus','categories','users','check','menus_count'));
    }

    public function orderHistory($email){
        $order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 1
            ])->get();
        return view('Order.orderhistory',compact('order_history'));
    }
    public function view_orderHistory($id,$email){
         $orders= Order::where([
            'email' => $email,
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
