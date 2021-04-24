<?php

namespace App\Http\Controllers;
use App\Category;
use App\Menu;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use DB;
use auth;
use Storage;
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

    public function category(Request $request){
         $uri = $request->path();
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
        $admin_id = auth::user()->id;
        $adminmessage_count = DB::table('messages')->where([
            'to_id' => $admin_id,
            'seen' => 0
        ])->count();
        $categories = Category::orderBy('category')->get();
        return view('Menu.create_menu', compact(
            'categories',
            'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count','uri'
        )
            );
    }
    public function store(Request $request){
        
        $request->validate([
            'food_name' => 'required',
            'menu_category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image:max:2048|mimes:jpg,jpeg'
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
    public function edit(Request $request, $id){
        $uri = $request->path();

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
        $admin_id = auth::user()->id;
        $adminmessage_count = DB::table('messages')->where([
            'to_id' => $admin_id,
            'seen' => 0
        ])->count();


        $menu = Menu::find($id);
        $categories = Category::orderBy('category')->get();
        return view('Menu.edit_menu', compact('menu','categories','uri','adminmessage_count','approved_count','pending_count','inprocess_count','Ondelivery_count','received_count'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'food_name' => 'required',
            'menu_category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image:max:2048|mimes:jpg,jpeg'
        ]);


        
        $menu = Menu::find($id);
        $menu->food_name =$request->input('food_name');
        $menu->menu_category=$request->input('menu_category');
        $menu->description=$request->input('description');
        $menu->price=$request->input('price');  

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = rand() . '.' .$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            $image->move(public_path('images'),$filename);
            
            $oldimage = $menu->image;
            $menu->image = $filename;
            Storage::delete($oldimage);
        }

        $menu->save();
        
        /*   $image = $request->file('image');
          $new_name = rand() . '.' .$image->getClientOriginalExtension();
          $image->move(public_path('images'),$new_name); */

        /* $form_data = array(
            'food_name' => $request->food_name,
            'menu_category' => $request->menu_category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $new_name
        ); */
       /*  $request->session()->flash('menu','Menu was created successfully!');
        ; */
        
/*         $menu->update($request->all());
 */        $request->session()->flash('edit','Edited successfully!');
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
