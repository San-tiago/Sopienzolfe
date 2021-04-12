<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\PlacedOrder;
use App\Message;
use Carbon\Carbon;
use App\ReceiverDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Notifications\UserNotification;
class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function store(Request $request){
        date_default_timezone_set('Asia/Manila');
        $quantity = $request->input('quantity');
        $user_id = $request->input('user_id');
        $price = $request->input('menu_price');
        $menu_image = $request->input('menu_image');
        $total = $quantity * $price;
        $data = request([
            'user_name',
            'user_id',
            'menu_id',
            'menu_name',
            'menu_image',
            'menu_category',
            'quantity',
            'menu_description', 
        ]);
        $status = 'Add Success';
        User::find($user_id)->notify(new UserNotification($status));
        
        $request->request->add(['menu_price'=>$total]);
        Order::create($request->all());
        return back();
    }

    public function view(){
        date_default_timezone_set('Asia/Manila');
        auth()->user()->unreadNotifications->markAsRead();
        $user = Auth::user()->email;
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
        $decline_messages_count = Message::where([
                'to_useremail'=> $user,
                'read_at'=> 0
                ])->count();
        $decline_messages = Message::where('to_useremail',$user)->get();
        $orders = Order::where([
            'email'=>$user,
            'status'=> ' ',
            ])->get(); 
        $total = Order::where([
            'email'=>$user,
            'status'=> ' ',
            ])->sum('menu_price');
        
            $user_form =  DB::table('receiver_details')->where([
                ['transac_status','=','0'],
                ['fromemail','=', $user]
               ])->orderBy('created_at', 'desc')
               ->limit(1)->get();
        
        return view('Order.order',compact('orders','total','message_count','decline_messages_count','decline_messages','user_form')); 
       
    }
    public function delete($id){
        $menu = Order::find($id);
        $menu -> delete();
        return back();
    }
    public function placeOrder(Request $request){
        date_default_timezone_set('Asia/Manila');
        $user = Auth::user()->email;
        User::where('email', $user)->update(['Order_Status'=>'Pending']); //ditooooooooooooooo
        Order::where('email', $user)->where(function ($query) {
            $user = Auth::user()->email;
            $query->where([
                'email' => $user,
                ])->whereNotIn('status',['Received','Cancelled','Declined'])->get();
                        })->update(['status'=>'Pending']);
        
        //User::find(['is_admin' => 1])->notify(new UserNotification);
        $status = 'Pending Order';
         User::find(1)->notify(new UserNotification($status));
        return redirect('/myorder');
    }
    public function receiver_page(){
        $user = Auth::user()->email;
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
        $decline_messages_count = Message::where([
                'to_useremail'=> $user,
                'read_at'=> 0
                ])->count();
        $decline_messages = Message::where('to_useremail',$user)->get();
        return view('Receiver.receiver',compact('message_count','decline_messages_count','decline_messages'));
    }
    public function receiver(Request $request){
          $data = request()->validate([
            'fromemail',
            'receivername' => 'required',
            'payment_type' => 'required',
            'receiveraddress' => 'required',
            'province' => 'required',
            'municipality/city' => 'required',
            'receivercontactnumber' => 'required|min:11',
        ]);
        $d = date("d");
        $m = date("m");
        date_default_timezone_set('Asia/Manila');
        $h = date('H');
        $i = date('i');
        $s = date('s');

        $order_number = '#'.$d.$m.$h.$i.$s;
        $request->request->add(['order_number'=>$order_number]);
        ReceiverDetails::create($request->all());
        $user = Auth::user()->email;
        User::where('email',$user)->update(['Order_Status' => 'Ordering']);
        $request->session()->flash('receiverForm','Form submitted successfully! You can order now.');


        return redirect('/home');
    }
    public function myorder(){
        $user = Auth::user()->email;
       /* echo $orders = DB::table('orders')->where([
            'email' => $user,
            ])->whereNotIn('status', ['Cancelled',])
            ->get(); */
            /* ->whereIn('id', [1, 2, 3])
            ->get(); */
            $message_count = db::table('messages')->where([
                'seen'=> 0,
                'from_id' => 1
                ])->count();


           $orders = DB::table('orders')
            ->where(function ($query) {
                $user = Auth::user()->email;
                $query->where([
                    'email' => $user,
                    ])->whereNotIn('status',['Received','Cancelled',' ','Declined'])->get();
                            })
                            ->get();

            $orders_sum = DB::table('orders')
                ->where(function ($query) {
                     $user = Auth::user()->email;
                        $query->where([
                             'email' => $user,
                                ])->whereNotIn('status',['Received','Cancelled',' ','Declined'])->get();
                                    })
                                    ->sum('menu_price');
                                    $decline_messages_count = Message::where([
                                        'to_useremail'=> $user,
                                        'read_at'=> 0
                                        ])->count();
                                $decline_messages = Message::where('to_useremail',$user)->get();
             $paymenttype = ReceiverDetails::where('fromemail',$user)->latest()->first();

             $user_form =  DB::table('receiver_details')->where([
                ['transac_status','=','0'],
                ['fromemail','=', $user]
               ])->orderBy('created_at', 'desc')
               ->limit(1)->get();
                             return view('Order.myorder',compact('orders','paymenttype','orders_sum','message_count','decline_messages_count','decline_messages','user_form')); 
        }
        
     public function cancelOrder($email,$id){
          User::where('email',$email)->update(['Order_Status' => 'None']); 
     
         echo DB::table('orders')->where([
             'email' => $email,
             'status' => 'Pending',
         ])->update(['status' => 'Cancelled']);
      
        DB::table('users')->where('email',$email)->increment('cancelled_orders_count');
        DB::table('receiver_details')
                ->where([
                    'fromemail' => $email,
                    'transac_status' => 0
                    ])  
                ->latest()
                ->update(['transac_status' => 'Cancelled']);
         return redirect('/home');
    }

    public function mycancelledOrders($email){
        $email = auth::user()->email;
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
        $cancelled_order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 'Cancelled'
            ])->get(); 
        //return view('Order.orderhistory',compact('order_history'));

        /* $cancelled_orders = Order::where([
            'email' => $email,
            'status' => 'Cancelled',
            ])->get(); */
            $decline_messages_count = Message::where([
                'to_useremail'=> $email,
                'read_at'=> 0
                ])->count();
        $decline_messages = Message::where('to_useremail',$email)->get();
        return view('Order.mycancelledorders',compact('cancelled_order_history','message_count','decline_messages_count','decline_messages')); 
    }
    public function cancelled_orderHistory($id,$email){
        $message_count = db::table('messages')->where([
            'seen'=> 0,
            'from_id' => 1
            ])->count();
       $orders= Order::where([
            'order_id' => $id,
            'email' => $email,
            'status' => 'Cancelled'
            ])->get();
        $total= Order::where([
            'email' => $email,
            'order_id' => $id,
            'status' => 'Cancelled'
            ])->sum('menu_price');
        $decline_messages_count = Message::where([
                'to_useremail'=> $email,
                'read_at'=> 0
                ])->count();
        $decline_messages = Message::where('to_useremail',$email)->get();
       return view('Order.view_cancelledorders',compact('orders','total','message_count','decline_messages_count','decline_messages'));
    }

    /* public function customerMessage(Request $request){
        $users = User::all();
        $user = $users->find(1);
        $to_useremail= $user->email;
        $from_useremail = Auth::user()->email;
        $message = $request->input('customermessage');
        date_default_timezone_set('Asia/Manila');
        $date = Carbon::now()->toDateTimeString();
        DB::table('message')->insert(
            ['from_useremail' => $from_useremail, 
            'to_useremail' => $to_useremail, 
            'created_at' => $date, 
            'message' => $message]
        );
        $request->session()->flash('message_sent','Message Sent!');
    
       
        return back();
    } */







}
