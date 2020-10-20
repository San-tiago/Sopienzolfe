<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
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
        return view ('admin.order');
    }
    public function sales(){
        return view ('admin.sale');
    }
    public function users(){
        return view ('admin.user');
    }

}
