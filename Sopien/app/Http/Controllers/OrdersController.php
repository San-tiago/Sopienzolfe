<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\PlacedOrder;
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

        $quantity = $request->input('quantity');
        $user_id = $request->input('user_id');
        $price = $request->input('menu_price');
        $total = $quantity * $price;
        $data = request([
            'user_name',
            'user_id',
            'menu_id',
            'menu_name',
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
        
        auth()->user()->unreadNotifications->markAsRead();
        $user = Auth::user()->email;
        $orders = Order::where([
            'email'=>$user,
            'status'=> ' ',
            ])->get();
        $total = Order::where([
            'email'=>$user,
            'status'=> ' ',
            ])->sum('menu_price');
        return view('Order.order',compact('orders','total')); 
       
    }
    public function delete($id){
        $menu = Order::find($id);
        $menu -> delete();
        return back();
    }
    public function placeOrder(Request $request){
        $user = Auth::user()->email;
        User::where('email', $user)->update(['Order_Status'=>'Pending']); //ditooooooooooooooo
        Order::where('email', $user)->where(function ($query) {
            $user = Auth::user()->email;
            $query->where([
                'email' => $user,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'Pending']);
        
        //User::find(['is_admin' => 1])->notify(new UserNotification);
        $status = 'Pending Order';
         User::find(1)->notify(new UserNotification($status));
        return redirect('/myorder');
    }
    public function receiver_page(){
       /*  $ncr_cities = Http::get('https://psgc.gitlab.io/api/regions/130000000/cities/')->body(); //NCR CITIES
        $calab_cities = Http::get('https://psgc.gitlab.io/api/regions/040000000/cities/')->body(); // CALABARZON CITIES
           $calab_prov = Http::get('https://psgc.gitlab.io/api/regions/040000000/provinces/')->body(); // provinces sa CALABARZON
          //$regions = Http::get('https://psgc.gitlab.io/api/regions/130000000/provinces/')->body(); // provinces sa NCR
         $municip = Http::get('https://psgc.gitlab.io/api/regions/040000000/municipalities')->body(); */
        
       /*  $data_calab = json_decode($calab_prov,true);
        $calab_cities = json_decode($calab_cities,true);
        $ncr_cities = json_decode($ncr_cities,true);
        $municip = json_decode($municip,true);

        $municip = collect($municip);
        $municip = $municip->sortBy('name'); */
        return view('Receiver.receiver');
    }
    public function receiver(Request $request){
          $data = request()->validate([
            'fromemail',
            'receivername' => 'required',
            'receiveraddress' => 'required',
            'province' => 'required',
            'municipality/city' => 'required',
            'receivercontactnumber' => 'required',
        ]);
        ReceiverDetails::create($request->all());
        $user = Auth::user()->email;
        User::where('email',$user)->update(['Order_Status' => 'Ordering']);
        

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
            
           $orders = DB::table('orders')
            ->where(function ($query) {
                $user = Auth::user()->email;
                $query->where([
                    'email' => $user,
                    ])->whereNotIn('status',['Received','Cancelled'])->get();
                            })
                            ->get();

            $orders_sum = DB::table('orders')
                ->where(function ($query) {
                     $user = Auth::user()->email;
                        $query->where([
                             'email' => $user,
                                ])->whereNotIn('status',['Received','Cancelled'])->get();
                                    })
                                    ->sum('menu_price');
                            
                             return view('Order.myorder',[
                                 'orders' => $orders,
                                 'orders_sum' => $orders_sum
                             ]); 
        }
        
     public function cancelOrder($email,$id){
         User::where('email',$email)->update(['Order_Status' => 'None']);
        Order::where([
            'email' => $email,
            'order_id' => $id
            ])->update(['status'=>'Cancelled']);
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
        
        $cancelled_order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 'Cancelled'
            ])->get(); 
        //return view('Order.orderhistory',compact('order_history'));

        /* $cancelled_orders = Order::where([
            'email' => $email,
            'status' => 'Cancelled',
            ])->get(); */
        return view('Order.mycancelledorders',compact('cancelled_order_history')); 
    }
    public function cancelled_orderHistory($id,$email){
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
       return view('Order.view_cancelledorders',compact('orders','total'));
    }







}
