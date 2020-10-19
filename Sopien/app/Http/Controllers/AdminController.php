<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view ('layouts.dashboard');
    }

    public function menu(){
        return view ('admin.menu');
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
