<?php

namespace App\Http\Controllers;
use App\Menu;
use App\User;
use App\Order;
use App\Category;

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
        return view('home',compact('menus','categories','users'));
    
    }

    public function menu_nav($category){
        $users = User::all();
        $menus = Menu::where('menu_category',$category)->get();
        $categories = Category::orderBy('category')->get();
        return view('home',compact('menus','categories','users'));
    }

    public function orderHistory($id){
       $received_orders = User::find($id)->orders()->where('status','Received')->get();
        return view('Order.orderhistory',compact('received_orders'));
    }
}
