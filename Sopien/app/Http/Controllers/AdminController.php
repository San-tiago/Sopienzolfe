<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Order;
use App\Category;
use App\ReceiverDetails;
use DB;
use Auth;
use Carbon\Carbon;
use App\Notifications\UserNotification;
class AdminController extends Controller
{
    //
    public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
        echo $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
        echo $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
        echo $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();
        echo $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();
        echo $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();
        return view ('layouts.dashboard',compact('pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }

    public function menu(){
        $category = Category::all();
        $menus = Menu::orderBy('food_name')->get();
        return view('admin.menu',[
            'menus'=>$menus,
            'category'=>$category
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
        $details = ReceiverDetails::where('fromemail', $email)->latest('created_at')->first();
        //Order::where('email', $email)->get();
       
        $users = User::where([
            'Order_Status' => 'Pending',
            ])->get();
       $filtered_pendingorders = Order::where([
           'email'=> $email,
           'status'=> 'Pending'
           ])->get();
       $total_filtered_pendingorders = Order::where([
           'email'=> $email,
           'status'=> 'Pending'
           ])->sum('menu_price');
        return view('admin.filtered_pendingorders',compact('filtered_pendingorders','users','total_filtered_pendingorders','details')); 
       
    }
    public function filtered_approveorders($email){
        $details = ReceiverDetails::where('fromemail', $email)->latest('created_at')->first();

        $users = User::where([
            'Order_Status' => 'Approved',
            ])->get();
       $filtered_approveorders = Order::where([
           'email'=> $email,
           'status'=> 'Approved'
           ])->get();
       $total_filtered_approveorders = Order::where([
           'email'=> $email,
           'status'=> 'Approved'
           ])->sum('menu_price');
        return view('admin.filtered_approveorders',compact('filtered_approveorders','users','total_filtered_approveorders','details')); 
       
    }
    public function filtered_processorders($email){
        $details = ReceiverDetails::where('fromemail', $email)->latest('created_at')->first();

        $users = User::where([
         
            'Order_Status' => 'Processed',
            ])->get();
       $filtered_processorders = Order::where([
           'email'=> $email,
           'status'=> 'Processed'
           ])->get();
       $total_filtered_processorders = Order::where([
           'email'=> $email,
           'status'=> 'Processed'
           ])->sum('menu_price');
        return view('admin.filtered_processorders',compact('filtered_processorders','users','total_filtered_processorders','details')); 
       
    }
    public function filtered_ondeliveryorders($email){
        $details = ReceiverDetails::where('fromemail', $email)->latest('created_at')->first();

        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'On Delivery',
            ])->get();
       $filtered_ondeliveryorders = Order::where([
           'email'=> $email,
           'status'=> 'On Delivery'
           ])->get();
       $total_filtered_ondeliveryorders = Order::where([
           'email'=> $email,
           'status'=> 'On Delivery'
           ])->sum('menu_price');
        return view('admin.filtered_ondeliveryorders',compact('filtered_ondeliveryorders','users','total_filtered_ondeliveryorders','details')); 
       
    }
    public function filtered_cancelledorders($id){
        $filtered_cancelledorders = User::find($id)->orders()->where('status','Cancelled')->get();
        return view('admin.filtered_cancelledorders',compact('filtered_cancelledorders')); 
       
    }

    public function filtered_receivedorders($id){
        
          $filtered_receivedorders = User::find($id)->orders()->where('status','Received')->get();
          $total_filtered_receivedorders = User::find($id)->orders()->where('status','Received')->sum('menu_price');
     
        return view('admin.filtered_receivedorders',compact('filtered_receivedorders','total_filtered_receivedorders')); 
       
    }

    //P R O C E S S I N G  O R D E R S !
    public function approvingorder($email){
       
        User::where('email', $email)->update(['Order_Status'=>'Approve']);
        Order::where('email', $email)->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'Approved']);
         $status = 'Order Approved';
        User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/pendingorders');
    }
    public function processingorder($email){
        User::where('email', $email)->update(['Order_Status'=>'Processed']);
        Order::where('email', $email)->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'Processed']);
            $status = 'Order In-process';
            User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/approvedorders');
    }
    public function deliveringorder($email){
        User::where('email', $email)->update(['Order_Status'=>'On Delivery']);
        Order::where('email', $email)->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'On Delivery']);
                        $status = 'Order On-delivery';
                        User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/processedorders');    
    }
    public function receivingorder($email,$id){
        DB::table('users')->where('email',$email)->increment('completed_orders_count');
        User::where('email', $email)->update(['Order_Status'=>'None']);
        // kailangan mo mapasa yung receiver details id sa baba
        DB::table('receiver_details')->where('id',$id)->update(['transac_status' => 1]);
        Order::where('email', $email)->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'Received']);
        $status = 'Order Received';
        User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/ondeliveryorders');    
    }


    // F E T C H I N G  O R D E R S 

    public function approvedorders(){
        echo $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
        echo $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
        
        DB::table('notifications')->where(['data->data' => 'Order Approved',
        'read_at' => null
        ])->update(['read_at'=>Carbon::now()]);
        echo $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();
        echo $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();

        echo $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();

        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Approve',
            ])->get();
       $approved_orders = Order::where([
            'status' => 'Approved'
            ])->get();
        return view('admin.approve_orders',compact('approved_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function pendingorders(){
        //echo $orders = User::find(1)->orders;
        //$user = Order::find(1)->users;
        echo $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
        echo $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
        echo $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();
        echo $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();
        echo $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();
        DB::table('notifications')->where(['data->data' => 'Pending Order',
            'read_at' => null
        ])->update(['read_at'=>Carbon::now()]);


        
        
         $users = User::where([
            
            'Order_Status' => 'Pending',
            ])->get();
      $pending_orders = Order::where([
            'status' => 'Pending'
            ])->get(); 
      /*  
        foreach($pending_orders as $pending_order){
            echo $pending_order->id;
        }
         */
        return view('admin.pending_orders',compact('pending_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function processedorders(){
        echo $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
        echo $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
        echo $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();

        echo $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();
        echo $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();
        DB::table('notifications')->where(['data->data' => 'Order In-process',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where([
            
            'Order_Status' => 'Processed',
            ])->get();
       $processed_orders = Order::where([
            'status' => 'Processed'
            ])->get();
        return view('admin.processed_orders',compact('processed_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function ondeliveryorders(){
        echo $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
        echo $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
        echo $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();

        echo $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();
        echo $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();
        DB::table('notifications')->where(['data->data' => 'Order On-delivery',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where([
          
            'Order_Status' => 'On Delivery',
            ])->get();
       $ondelivery_orders = Order::where([
            'status' => 'On Delivery'
            ])->get();
        return view('admin.ondelivery_orders',compact('ondelivery_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function receivedorders(){
        echo $approved_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Approved',
            'read_at' => null
            ])
        ->count();
        echo $pending_count = DB::table('notifications')
        ->where([
            'data->data' => 'Pending Order',
            'read_at' => null
            ])
        ->count();
        echo $inprocess_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order In-process',
            'read_at' => null
            ])
        ->count();

        echo $Ondelivery_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order On-delivery',
            'read_at' => null
            ])
        ->count();
        echo $received_count = DB::table('notifications')
        ->where([
            'data->data' => 'Order Received',
            'read_at' => null
            ])
        ->count();
        DB::table('notifications')->where(['data->data' => 'Order Received',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where('completed_orders_count', '>',0)->get();
       $received_orders = Order::where([
            'status' => 'Received'
            ])->orderBy('email')->get();
        return view('admin.received_orders',compact('received_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function cancelledorders(){
       $users = User::where('cancelled_orders_count', '>',0)->get();
       $cancelled_orders = Order::where([
            'status' => 'Cancelled'
            ])->orderBy('menu_name')->get();
        
        return view('admin.cancelled_orders',compact('cancelled_orders','users'));
    }

    public function sales(){
        //DAILY
        $orders_today = Order::whereDate('created_at',today())->where('status','Received')->get(); // orders today
        if($orders_today == null){
           $orders_today = 'No Orders Today';
        }
       $totalsales_today = Order::whereDate('created_at',today())->where('status','Received')->sum('menu_price'); // total daily sales
        //MONTHLY
        $orders_month = Order::whereYear('created_at',now()->year)->whereMonth('created_at',now()->month)->where('status','Received')->get(); // orders in month
        $totalsales_monthly = Order::whereYear('created_at',now()->year)->whereMonth('created_at',now()->month)->where('status','Received')->sum('menu_price'); // total monthly sales

        //MENU
       $menus = Menu::orderBy('food_name')->get();
       /*  foreach($menus as $menu){
           $menu_id = $menu->id;
            $menu = Menu::find($menu_id)->menu()->where('status','Received')->sum('menu_price');
        } */
       return view ('admin.sale',compact(
                                        'orders_today',
                                        'orders_month',
                                        'totalsales_today',
                                        'totalsales_monthly',
                                        'menus',));

    }

    public function filtered_menusales($id){
    
       $menusales_sum = Menu::find($id)->menu()->where('status','Received')->sum('menu_price');
       //echo $menu_name = Menu::where('id',$id)->get('food_name');
       $menu_details = Menu::find($id)->menu()->where('status','Received')->get();
        $menu = Order::find($id);
        $menu_name = $menu->menu_name;
      return view('admin.filtered_menusales',compact('menusales_sum','menu_details','menu_name')); 
    }

    // USER MANAGEMENT! 

    public function users(){
        $users = User::all();

        return view ('admin.user',compact('users'));
    }

    public function deactivate_account($id){
        User::where('id', $id)->update(['Account_Status'=>'Deactivated']);
        return back();
    }
    public function activate_account($id){
        User::where('id', $id)->update(['Account_Status'=>'Active']);   
        return back();
    }

}
