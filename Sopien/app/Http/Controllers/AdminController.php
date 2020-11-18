<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Order;
use DB;
class AdminController extends Controller
{
    //
    public function index(){
        return view ('layouts.dashboard');
    }

    public function menu(){
        $menus = Menu::orderBy('food_name')->get();
        return view('admin.menu',[
            'menus'=>$menus
            ]);

        
    }
    public function orders(){
        $users = User::where('provider_id','=', null)->get();
        return view ('admin.order',[
            'users' => $users,
        ]);
    }

    // F I L T E R E D  O R D E R S / U S E R
    public function filtered_pendingorders($email){
        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Pending',
            ])->get();
       $filtered_pendingorders = Order::where([
           'email'=> $email,
           'status'=> 'Pending'
           ])->get();
        return view('admin.filtered_pendingorders',compact('filtered_pendingorders','users')); 
       
    }
    public function filtered_approveorders($email){
        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Approve',
            ])->get();
       $filtered_approveorders = Order::where([
           'email'=> $email,
           'status'=> 'Approve'
           ])->get();
        return view('admin.filtered_approveorders',compact('filtered_approveorders','users')); 
       
    }
    public function filtered_processorders($email){
        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Processed',
            ])->get();
       $filtered_processorders = Order::where([
           'email'=> $email,
           'status'=> 'Processed'
           ])->get();
        return view('admin.filtered_processorders',compact('filtered_processorders','users')); 
       
    }
    public function filtered_ondeliveryorders($email){
        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'On Delivery',
            ])->get();
       $filtered_ondeliveryorders = Order::where([
           'email'=> $email,
           'status'=> 'On Delivery'
           ])->get();
        return view('admin.filtered_ondeliveryorders',compact('filtered_ondeliveryorders','users')); 
       
    }

    public function filtered_receivedorders($email){
        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Received',
            ])->get();
       $filtered_receivedorders = Order::where([
           'email'=> $email,
           'status'=> 'Received'
           ])->get();
        return view('admin.filtered_receivedorders',compact('filtered_receivedorders','users')); 
       
    }

    //P R O C E S S I N G  O R D E R S !
    public function approvingorder($email){
     
        User::where('email', $email)->update(['Order_Status'=>'Approve']);
        Order::where('email', $email)->update(['status'=>'Approve']);
        return redirect('/admin/pendingorders');
    }
    public function processingorder($email){
        User::where('email', $email)->update(['Order_Status'=>'Processed']);
        Order::where('email', $email)->update(['status'=>'Processed']);
        return redirect('/admin/approvedorders');
    }
    public function deliveringorder($email){
        User::where('email', $email)->update(['Order_Status'=>'On Delivery']);
        Order::where('email', $email)->update(['status'=>'On Delivery']);
        return redirect('/admin/processedorders');    
    }
    public function receivingorder($email){
        DB::table('users')->increment('completed_orders_count');
        User::where('email', $email)->update(['Order_Status'=>'None']);
        Order::where('email', $email)->update(['status'=>'Received']);
        return redirect('/admin/ondeliveryorders');    
    }


    // F E T C H I N G  O R D E R S 

    public function approvedorders(){
        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Approve',
            ])->get();
       $approved_orders = Order::where([
            'status' => 'Approve'
            ])->get();
        return view('admin.approve_orders',compact('approved_orders','users'));
    }
    public function pendingorders(){
        //echo $orders = User::find(1)->orders;
        //$user = Order::find(1)->users;
        
      
    
         $users = User::where([
            
            'Order_Status' => 'Pending',
            ])->get();
       $pending_orders = Order::where([
            'status' => 'Pending'
            ])->get();
        return view('admin.pending_orders',compact('pending_orders','users'));
    }
    public function processedorders(){
        $users = User::where([
            
            'Order_Status' => 'Processed',
            ])->get();
       $processed_orders = Order::where([
            'status' => 'Processed'
            ])->get();
        return view('admin.processed_orders',compact('processed_orders','users'));
    }
    public function ondeliveryorders(){
        $users = User::where([
          
            'Order_Status' => 'On Delivery',
            ])->get();
       $ondelivery_orders = Order::where([
            'status' => 'On Delivery'
            ])->get();
        return view('admin.ondelivery_orders',compact('ondelivery_orders','users'));
    }
    public function receivedorders(){
        $users = User::where('completed_orders_count', '>',0)->get();
       
       $received_orders = Order::where([
            'status' => 'Received'
            ])->orderBy('email')->get();
        return view('admin.received_orders',compact('received_orders','users'));
    }

    public function sales(){
        
        $orders_today = Order::whereDate('created_at',today())->get(); // orders today
        $totalsales_today = Order::whereDate('created_at',today())->sum('menu_price'); // sum
        $orders_month = Order::whereYear('created_at',now()->year)->whereMonth('created_at',now()->month)->get(); // orders in month
        $totalsales_monthly = Order::whereYear('created_at',now()->year)->whereMonth('created_at',now()->month)->sum('menu_price'); // orders in month
        return view ('admin.sale',compact('orders_today','orders_month','totalsales_today','totalsales_monthly'));
    }
    public function users(){
     
        
        return view ('admin.user');
    }

}
