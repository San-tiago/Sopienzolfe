<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Menu;
use App\User;
use App\Order;
use App\Category;
use App\Message;
use App\CustomerReview;
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
        $this->middleware(['auth'=>'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function termsnconditions(){
        $email = auth::user()->email;
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
       
        return view('terms&conditions',compact('message_count'));
    }
    public function index(){   
        
        $email = auth::user()->email;
        $users = User::all();
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
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
         $decline_messages_count = Message::where([
             'to_useremail'=> $email,
             'read_at'=> 0
             ])->count();
         $decline_messages = Message::where('to_useremail',$email)->orderBy('created_at','desc')->get();
         $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
        return view('home',compact('menus','categories','users','new_transac','menus_count','decline_messages','decline_messages_count','message_count'));
    
    }

    public function menu_nav($category){
        $email = auth::user()->email;
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
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
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
        $order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 1
            ])->get();
        $decline_messages_count = Message::where([
                'to_useremail'=> $email,
                'read_at'=> 0
                ])->count();
        $decline_messages = Message::where('to_useremail',$email)->get();
        return view('Order.orderhistory',compact('order_history','message_count','decline_messages_count','decline_messages'));
    }
    public function view_orderHistory($id,$email){
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
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
        $decline_messages_count = Message::where([
                'to_useremail'=> $email,
                'read_at'=> 0
                ])->count();
        $decline_messages = Message::where('to_useremail',$email)->get();
        return view('Order.view_historyorder',compact('orders','total','message_count','decline_messages_count','decline_messages'));
    }

    /* public function unread_message(){
        $email = auth::user()->email;
        $date = Carbon::now()->toDateTimeString();
        
        return redirect('/messages');
        
    } */

    /* public function messages(){
    

        $email = auth::user()->email;
        $message_count = Message::where([
            'read_at'=> 0,
            'to_useremail' => $email
            ])->count();

        date_default_timezone_set('Asia/Manila');
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
    } */


    public function customer_review(){
        $email = auth::user()->email;
        $users = User::all();
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
        return view('customerreview');
    }

    public function insert_review(Request $request){
        $user = auth::user()->name;
        $message = $request->input('review_message');
        DB::table('customerreview')->insert(
            ['customer_name' => $user, 
            'review_message' => $message]
        );
        return redirect('/home');
    }

    public function mark_asread($id){
        //may error pa
        /* $user_email = auth::user()->id; */
        echo $id;
        DB::table('message')->where([
            'id' => $id,
            'read_at' => 0
            ])->update(['read_at' => '1']);  
        
        return back();

    }

}
