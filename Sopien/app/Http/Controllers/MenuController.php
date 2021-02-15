<?php

namespace App\Http\Controllers;
use App\Category;
use App\Menu;
use App\User;
use App\Message;
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
        $admin = User::find(1);
        $admin_email = $admin->email;
        $adminmessage_count = Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->count();
        $categories = Category::orderBy('category')->get();
        return view('Menu.create_menu', compact(
            'categories',
            'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count'
        )
            );
    }
    public function store(Request $request){
        
        $request->validate([
            'food_name' => 'required',
            'menu_category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image:max:2048'
        ]);
        /* $menu = new Menu();
        $menu->food_name = $request->input('food_name');
        $menu->menu_category = $request->input('menu_category');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price'); */

        /* if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/menus/',$filename);
            $menu->image = $filename;

        }
        else {
            return $request;
            $menu->image = '';
        } */
        $image = $request->file('image');
        $new_name = rand() . '.' .$image->getClientOriginalExtension();
        $image->move(public_path('images'),$new_name);
        $form_data = array(
            'food_name' => $request->food_name,
            'menu_category' => $request->menu_category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $new_name
        );
        $request->session()->flash('menu','Menu was created successfully!');
        Menu::create($form_data);
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
