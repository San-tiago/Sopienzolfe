<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Order;
use App\Category;
use App\Message;
use App\ReceiverDetails;
use DB;
use PDF;
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
         $user_count = DB::table('users')
        ->count();

        $admin = User::find(1);
        $admin_email = $admin->email;
        $adminmessage_count = Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->count();
        return view ('admin.admin_dashboard',compact('user_count','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count'));
    }

    public function menu(){
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

        $category = Category::all();
        $menus = Menu::orderBy('food_name')->get();
        return view('admin.menu', compact(
            'menus',
            'category',
            'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count'
            )
            
            );

        
    }
    public function orders(){
        $users = User::where('provider_id','=', null)->get();
        return view ('admin.order',[
            'users' => $users,
        ]);
    }

    // F I L T E R E D  O R D E R S / U S E R
    public function filtered_pendingorders($email){
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
        return view('admin.filtered_pendingorders',compact('filtered_pendingorders','users','total_filtered_pendingorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count')); 
       
    }
    public function filtered_approveorders($email){
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
        return view('admin.filtered_approveorders',compact('adminmessage_count','filtered_approveorders','users','total_filtered_approveorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count')); 
       
    }
    public function filtered_processorders($email){
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
        return view('admin.filtered_processorders',compact('adminmessage_count','filtered_processorders','users','total_filtered_processorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count')); 
       
    }
    public function filtered_ondeliveryorders($email){
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
        return view('admin.filtered_ondeliveryorders',compact('adminmessage_count','filtered_ondeliveryorders','users','total_filtered_ondeliveryorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count')); 
       
    }
    public function filtered_cancelledorders($id){
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

        $filtered_cancelledorders = User::find($id)->orders()->where('status','Cancelled')->get();
        return view('admin.filtered_cancelledorders',compact('adminmessage_count','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','filtered_cancelledorders')); 
       
    }

    public function filtered_receivedorders($id,$email){
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

             $order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 1
            ])->get();
        
         /*  $filtered_receivedorders = User::find($id)->orders()->where('status','Received')->get();
          $total_filtered_receivedorders = User::find($id)->orders()->where('status','Received')->sum('menu_price'); */
     
        return view('admin.filtered_receivedorders',compact('adminmessage_count','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','order_history')); 
       
    }

    //P R O C E S S I N G  O R D E R S !
    public function approvingorder($order_id,$email){
       
        User::where('email', $email)->update(['Order_Status'=>'Approve']);
        Order::where([
            'email'=>$email,
            'order_id'=>$order_id
            ])->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled','Declined'])->get();
                        })->update(['status'=>'Approved']);
         $status = 'Order Approved';
        User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/pendingorders');
    }
    public function processingorder($order_id,$email){
        User::where('email', $email)->update(['Order_Status'=>'Processed']);
        Order::where([
            'email'=>$email,
            'order_id'=>$order_id
            ])->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'Processed']);
            $status = 'Order In-process';
            User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/approvedorders');
    }
    public function deliveringorder($order_id,$email){
        User::where('email', $email)->update(['Order_Status'=>'On Delivery']);
        Order::where([
            'email'=>$email,
            'order_id'=>$order_id
            ])->when($email,function ($query,$email) {

            $query->where([
                'email' => $email,
                ])->whereNotIn('status',['Received','Cancelled'])->get();
                        })->update(['status'=>'On Delivery']);
                        $status = 'Order On-delivery';
                        User::find(1)->notify(new UserNotification($status));
        return redirect('/admin/processedorders');    
    }
    public function receivingorder($id,$email){
        DB::table('users')->where('email',$email)->increment('completed_orders_count');
        User::where('email', $email)->update(['Order_Status'=>'None']);
        // kailangan mo mapasa yung receiver details id sa baba
        DB::table('receiver_details')->where('id',$id)->update(['transac_status' => 1]);
        Order::where([
            'email' => $email,
            'order_id' => $id,
            ])->when($email,function ($query,$email) {

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
        
        DB::table('notifications')->where(['data->data' => 'Order Approved',
        'read_at' => null
        ])->update(['read_at'=>Carbon::now()]);
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

        $users = User::where([
            'provider_id' => null,
            'Order_Status' => 'Approve',
            ])->get();
       $approved_orders = Order::where([
            'status' => 'Approved'
            ])->get();
        return view('admin.approve_orders',compact('adminmessage_count','approved_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function pendingorders(){
        //echo $orders = User::find(1)->orders;
        //$user = Order::find(1)->users;
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
        return view('admin.pending_orders',compact('adminmessage_count','pending_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function processedorders(){
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

        DB::table('notifications')->where(['data->data' => 'Order In-process',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where([
            
            'Order_Status' => 'Processed',
            ])->get();
       $processed_orders = Order::where([
            'status' => 'Processed'
            ])->get();
        return view('admin.processed_orders',compact('adminmessage_count','processed_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function ondeliveryorders(){
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

        $admin = User::find(1);
        $admin_email = $admin->email;
        $adminmessage_count = Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->count();

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
        DB::table('notifications')->where(['data->data' => 'Order On-delivery',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where([
          
            'Order_Status' => 'On Delivery',
            ])->get();
       $ondelivery_orders = Order::where([
            'status' => 'On Delivery'
            ])->get();
        return view('admin.ondelivery_orders',compact('adminmessage_count','ondelivery_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function receivedorders(){
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

        DB::table('notifications')->where(['data->data' => 'Order Received',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where('completed_orders_count', '>',0)->get();
       $received_orders = Order::where([
            'status' => 'Received'
            ])->orderBy('email')->get();
        return view('admin.received_orders',compact('adminmessage_count','received_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }
    public function cancelledorders(){
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

       $users = User::where('cancelled_orders_count', '>',0)->get();
       $cancelled_orders = Order::where([
            'status' => 'Cancelled'
            ])->orderBy('menu_name')->get();
        
        return view('admin.cancelled_orders',compact('adminmessage_count','cancelled_orders','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }

    public function sales(){

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
                                        'menus',
                                        'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count'));

    }

    public function filtered_menusales($id){
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

       $menusales_sum = Menu::find($id)->menu()->where('status','Received')->sum('menu_price');
       //echo $menu_name = Menu::where('id',$id)->get('food_name');
       $menu_details = Menu::find($id)->menu()->where('status','Received')->get();
        $menu = Order::find($id);
        $menu_name = $menu->menu_name;
      return view('admin.filtered_menusales',compact('adminmessage_count','menusales_sum','menu_details','menu_name','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count')); 
    }

    // USER MANAGEMENT! 

    public function users(){
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
        $users = User::all();

        return view ('admin.user',compact('adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
    }

    public function deactivate_account($id){
        User::where('id', $id)->update(['Account_Status'=>'Deactivated']);
        return back();
    }
    public function activate_account($id){
        User::where('id', $id)->update(['Account_Status'=>'Active']);   
        return back();
    }

    public function view_summary($id,$email){
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

        $orders= Order::where([
           'email' => $email,
           'order_id' => $id,
           'status' => 'Received'
           ])->get();
       $total= Order::where([
           'order_id' => $id,
           'status' => 'Received'
           ])->sum('menu_price');
       return view('admin.view_summary',compact('adminmessage_count','orders','total','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count'));
   }


   public function decline_order(Request $request,$order_id,$email){
       //User::find($id)->notify(new UserNotification($message));
       
       
    DB::table('orders')
    ->where([
        'order_id' => $order_id,
        'email' => $email
    ])->update(['status' => 'Declined']);
    
    DB::table('users')
    ->where([
        'email' => $email
    ])
    ->update(['Order_Status' => 'None']);

    $from_useremail = Auth::user()->email;
    $message = $request->input('message');
    date_default_timezone_set('Asia/Manila');
    $date = Carbon::now()->toDateTimeString();
  
    DB::table('message')->insert(
        ['from_useremail' => $from_useremail, 
        'to_useremail' => $email, 
        'message' => $message,
        'created_at' => $date]
    );
    $request->session()->flash('adminmessage_sent','Message Sent!');

    /* Message::create($request->all()); */
    
    return redirect('/admin/pendingorders');
    
   }

   public function generateReceipt($email){
    $user = $email;
    $filtered_pendingorders = Order::where([
        'email'=> $email,
        'status'=> 'Pending'
        ])->get();
    $total_filtered_pendingorders = Order::where([
        'email'=> $email,
        'status'=> 'Pending'
        ])->sum('menu_price');

    $pdf = PDF::loadview('receipt',[
        'user' => $user,
        'filtered_pendingorders' => $filtered_pendingorders,
        'total_filtered_pendingorders' => $total_filtered_pendingorders
        ]);
    return $pdf->stream('receipt.pdf');
     
/*        return view('receipt',compact('filtered_pendingorders','total_filtered_pendingorders','user'));
 */

      
       
   }

   public function messages(){

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
    $messages = Message::where('from_useremail','!=',$admin_email)->get();
    $adminmessage_count = Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->count();
    date_default_timezone_set('Asia/Manila');
    $date = Carbon::now()->toDateTimeString();
    Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->update(['read_at' => $date]);   

   
    return view('admin.messages',compact('messages','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','adminmessage_count'));
   }

}
