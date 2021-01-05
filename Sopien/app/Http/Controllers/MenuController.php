<?php

namespace App\Http\Controllers;
use App\Category;
use App\Menu;
use Illuminate\Http\Request;
use DB;
class MenuController extends Controller
{   
    public function __construct()
{
    $this->middleware('auth');
}
    //
   /*  function construct(){
         $categories = Category::orderBy('category')->get();
        return view('Menu.edit_menu',[
           'categories'=>$categories
            ]);
        } */

    public function category(){
        $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
         $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
         $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();
         $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();
         $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();
        $categories = Category::orderBy('category')->get();
        return view('Menu.create_menu', compact(
            'categories',
            'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'
        )
            );
    }
    public function store(Request $request){
        $data = request()->validate([
            'food_name' => 'required',
            'menu_category' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $request->session()->flash('menu','Menu was created successfully!');
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
        $request->session()->flash('edit','Edit successfully!');
        return redirect('/admin/menu');
    }

    public function create(){

        return view('Menu.create_menu');
    }

    public function delete($id){
        DB::table('menus')->where('id',$id)->delete();
        return back()->with('delete','Deleted Successfuly!');
    }
}
