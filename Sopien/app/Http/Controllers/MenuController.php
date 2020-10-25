<?php

namespace App\Http\Controllers;
use App\Category;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
   /*  function construct(){
         $categories = Category::orderBy('category')->get();
        return view('Menu.edit_menu',[
           'categories'=>$categories
            ]);
        } */

    public function category(){
        $categories = Category::orderBy('category')->get();
        return view('Menu.create_menu',[
            'categories'=>$categories
            ]);
    }
    public function store(Request $request){
        $data = request()->validate([
            'food_name' => 'required',
            'menu_category' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        Menu::create($request->all());
        return redirect('/admin/menu');
    }
    public function edit($id){
        $menu = Menu::find($id);
        $categories = Category::orderBy('category')->get();
        return view('Menu.edit_menu', compact('menu','categories'));
    }
    public function update(Request $request, $id){
        $menu = Menu::find($id);
        $menu->update($request->all());
        return redirect('/admin/menu');
    }

    public function create(){
        return view('Menu.create_menu');
    }

    public function delete($id){
        $menu = Menu::find($id);
        $menu -> delete();
        return back();
    }
}
