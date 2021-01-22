<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Menu;
use App\User;
use App\Order;
use App\Category;
use App\Message;
use App\ReceiverDetails;
use Auth;
use DB;
use Carbon\Carbon;

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
    public function index(){   

        $email = auth::user()->email;
        $users = User::all();
        
        $message_count = Message::where([
            'read_at'=> null,
            'to_useremail' => $email
            ])->count();

        $menus = Menu::all();
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
                
        return view('home',compact('menus','categories','users','new_transac','menus_count','message_count'));
    
    }

    public function menu_nav($category){
        $email = auth::user()->email;
        $message_count = Message::where([
            'read_at'=> null,
            'to_useremail' => $email
            ])->count();

        $users = User::all();
        $menus = Menu::where('menu_category',$category)->get();
        $menus_count = count($menus);
        $categories = Category::orderBy('category')->get();
        $new_transac = ReceiverDetails::where('fromemail',Auth::user()->email)->max('id');
        $check = DB::table('receiver_details')
        ->where([
            'fromemail' => Auth::user()->email,
            'transac_status' => 0
            ])
        ->latest()
        ->get(); 
        return view('home',compact('menus','categories','users','check','menus_count','new_transac','message_count'));
    }

    public function orderHistory($email){
        $message_count = Message::where([
            'read_at'=> null,
            'to_useremail' => $email
            ])->count();
        $order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 1
            ])->get();
        return view('Order.orderhistory',compact('order_history','message_count'));
    }
    public function view_orderHistory($id,$email){
        $message_count = Message::where([
            'read_at'=> null,
            'to_useremail' => $email
            ])->count();
         $orders= Order::where([
            'email' => $email,
            'order_id' => $id,
            'status' => 'Received'
            ])->get();
        $total= Order::where([
            'order_id' => $id,
            'status' => 'Received'
            ])->sum('menu_price');
        return view('Order.view_historyorder',compact('orders','total','message_count'));
    }

    /* public function unread_message(){
        $email = auth::user()->email;
        $date = Carbon::now()->toDateTimeString();
        
        return redirect('/messages');
        
    } */

    public function messages(){
        $email = auth::user()->email;
        $message_count = Message::where([
            'read_at'=> null,
            'to_useremail' => $email
            ])->count();

        
        $date = Carbon::now()->toDateTimeString();
        $unread = Message::where([
            'to_useremail' =>$email,
            'read_at' => null
            ])->get();
        if($unread != null){
            Message::where([
                'to_useremail' =>$email,
                'read_at' => null
                ])->update(['read_at' => $date]);    
        }
        $messages = Message::where('to_useremail',$email)->orderBy('created_at','DESC')->get();
        return view('messages',compact('message_count','messages'));
    }

}
