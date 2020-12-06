<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\PlacedOrder;
use App\ReceiverDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserNotification;
class OrdersController extends Controller
{
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
        User::find($user_id)->notify(new UserNotification);
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
      
        return redirect('/myorder');
    }
    public function receiver_page(){
        return view('Receiver.receiver');
    }
    public function receiver(Request $request){
          $data = request()->validate([
            'fromemail',
            'receivername' => 'required',
            'receiveraddress' => 'required',
            'receivercontactnumber' => 'required',
        ]);
        ReceiverDetails::create($request->all());
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
                            
                             return view('Order.myorder',[
                                 'orders' => $orders,
                             ]); 
        }
        
     public function cancelOrder($email){
         User::where('email',$email)->update(['Order_Status' => 'None']);
        Order::where('email', $email)->update(['status'=>'Cancelled']);
        DB::table('users')->where('email',$email)->increment('cancelled_orders_count');
        return redirect('/home');
    }

    public function mycancelledOrders($email){

        $cancelled_orders = Order::where([
            'email' => $email,
            'status' => 'Cancelled',
            ])->get();
        return view('Order.mycancelledorders',compact('cancelled_orders')); 
    }







}
