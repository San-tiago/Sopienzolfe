<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Message;
use App\User;
use DB;
use auth;
class CategoryController extends Controller
{
    //
    public function __construct()
{
    $this->middleware('auth');
}
    public function index(Request $request){
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
        return view('Category.categories', compact(
            'categories',
            'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count','uri'
        )
            );
    }
    public function create(Request $request){
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
         return view('Category.createcategory',compact('pending_count','adminmessage_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }
    public function store(Request $request){
        $data = request()->validate([
            'category' => 'required',
        ]);
        Category::firstOrCreate(
            [
                'category' => request('category'),
            ]
        );
        $request->session()->flash('category_added','Category Added Successfully!');
        return redirect('/admin/categories');
    }
    public function edit(Request $request,$id){
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
        $category = Category::find($id);
        return view('Category.editcategory',compact('category','uri'));
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->update($request->all());
        return redirect('/admin/categories');
    }

    public function delete($id){
        $category = Category::find($id);
        $category -> delete();
        return back()->with('delete','Deleted Successfuly!');;
    }

}
