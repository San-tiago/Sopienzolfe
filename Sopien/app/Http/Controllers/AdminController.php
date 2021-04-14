<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Order;
use App\Receipt;
use App\Category;
use App\Message;
use App\Gcash;
use App\ReceiverDetails;
use DB;
use PDF;
use Auth;
use Storage;
use Carbon\Carbon;
use App\Notifications\UserNotification;
class AdminController extends Controller
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
         $receivedorder_count = DB::table('receiver_details')
        ->where([
            'transac_status' => 1
            ])
        ->count();
         $cancelledorder_count = DB::table('receiver_details')
        ->where([
            'transac_status' => 'Cancelled'
            ])
        ->count();
         $pendingorder_count = DB::table('receiver_details')
        ->where([
            'transac_status' => 'Pending'
            ])
        ->count();
         $user_count = DB::table('users')
        ->count();
        
        
        $admin_id = auth::user()->id;
        $adminmessage_count = DB::table('messages')->where([
            'to_id' => $admin_id,
            'seen' => 0
        ])->count();
        return view ('admin.admin_dashboard',compact(
                        'user_count','pending_count',
                        'approved_count','inprocess_count',
                        'Ondelivery_count','received_count',
                        'receivedorder_count','cancelledorder_count',
                        'pendingorder_count','adminmessage_count','uri'));
    }

    public function menu(Request $request){
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
        $category = Category::all();
        $menus = Menu::orderBy('food_name')->get();
        return view('admin.menu', compact(
            'menus',
            'adminmessage_count',
            'category',
            'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'
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
    public function filtered_pendingorders(Request $request, $email){

       $uri = request()->segment(2);

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
        $customer = User::where('email',$email)->get();
        return view('admin.filtered_pendingorders',compact('filtered_pendingorders',
        'adminmessage_count',
        'users','total_filtered_pendingorders',
        'details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','customer','uri')); 
       
    }
    public function filtered_approveorders(Request $request,$email){
          $uri = request()->segment(2);

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
        return view('admin.filtered_approveorders',compact('filtered_approveorders','adminmessage_count','users','total_filtered_approveorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri')); 
       
    }
    public function filtered_processorders(Request $request, $email){
          $uri = request()->segment(2);

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
        return view('admin.filtered_processorders',compact('filtered_processorders','adminmessage_count','users','total_filtered_processorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri')); 
       
    }
    public function filtered_ondeliveryorders(Request $request,$email){
          $uri = request()->segment(2);

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

        $details = ReceiverDetails::where('fromemail', $email)->latest('created_at')->first();

        $users = User::where([
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
        return view('admin.filtered_ondeliveryorders',compact('filtered_ondeliveryorders','adminmessage_count','users','total_filtered_ondeliveryorders','details','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri')); 
       
    }
    public function filtered_cancelledorders(Request $reques,$id){
          $uri = request()->segment(2);

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
        $filtered_cancelledorders = User::find($id)->orders()->where('status','Cancelled')->get();
        return view('admin.filtered_cancelledorders',compact('pending_count','adminmessage_count','approved_count','inprocess_count','Ondelivery_count','received_count','filtered_cancelledorders','uri')); 
       
    }

    public function filtered_receivedorders(Request $request,$id,$email){
          $uri = request()->segment(2);

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
             $order_history = ReceiverDetails::where([
            'fromemail' => $email,
            'transac_status' => 1
            ])->get();
        
         /*  $filtered_receivedorders = User::find($id)->orders()->where('status','Received')->get();
          $total_filtered_receivedorders = User::find($id)->orders()->where('status','Received')->sum('menu_price'); */
     
        return view('admin.filtered_receivedorders',compact('pending_count','adminmessage_count','approved_count','inprocess_count','Ondelivery_count','received_count','order_history','uri')); 
       
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

    public function approvedorders(Request $request){

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

        $admin_id = auth::user()->id;
        $adminmessage_count = DB::table('messages')->where([
            'to_id' => $admin_id,
            'seen' => 0
        ])->count();
        $users = User::where([
            
            'Order_Status' => 'Approve',
            ])->get();
       $approved_orders = Order::where([
            'status' => 'Approved'
            ])->get();
        return view('admin.approve_orders',compact('approved_orders','adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }
    public function pendingorders(Request $request){
        //  $orders = User::find(1)->orders;
        //$user = Order::find(1)->users;
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

        DB::table('notifications')->where(['data->data' => 'Pending Order',
            'read_at' => null
        ])->update(['read_at'=>Carbon::now()]);


        
        
         $users = User::where([
            
            'Order_Status' => 'Pending',
            ])->get();
            
      $pending_orders = Order::where([
            'status' => 'Pending'
            ])->get(); 
     
        return view('admin.pending_orders',compact('pending_orders','adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }
    public function processedorders(Request $request){

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

        DB::table('notifications')->where(['data->data' => 'Order In-process',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where([
            
            'Order_Status' => 'Processed',
            ])->get();
       $processed_orders = Order::where([
            'status' => 'Processed'
            ])->get();
        return view('admin.processed_orders',compact('processed_orders','adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }
    public function ondeliveryorders(Request $request){
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

        $admin_id = auth::user()->id;
        $adminmessage_count = DB::table('messages')->where([
            'to_id' => $admin_id,
            'seen' => 0
        ])->count();

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
        return view('admin.ondelivery_orders',compact('ondelivery_orders','adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }
    public function receivedorders(Request $request){
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

        DB::table('notifications')->where(['data->data' => 'Order Received',
        'read_at' => null
    ])->update(['read_at'=>Carbon::now()]);
        $users = User::where('completed_orders_count', '>',0)->get();
       $received_orders = Order::where([
            'status' => 'Received'
            ])->orderBy('email')->get();
        return view('admin.received_orders',compact('received_orders','adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }
    public function cancelledorders(Request $request){
          $uri = request()->segment(2);

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


       $users = User::where('cancelled_orders_count', '>',0)->get();
       $cancelled_orders = Order::where([
            'status' => 'Cancelled'
            ])->orderBy('menu_name')->get();
        
        return view('admin.cancelled_orders',compact('cancelled_orders','adminmessage_count','users','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }

    public function sales(Request $request){
          $uri = request()->segment(2);

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


        //DAILY
        $orders_today = Order::whereDate('created_at',today())->where('status','Received')->get(); // orders today
       
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
                                        'adminmessage_count',
                                        'orders_month',
                                        'totalsales_today',
                                        'totalsales_monthly',
                                        'menus',
                                        'pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));

    }

    public function filtered_menusales(Request $request, $id){
          $uri = request()->segment(2);

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

       $menusales_sum = Menu::find($id)->menu()->where('status','Received')->sum('menu_price');
       //  $menu_name = Menu::where('id',$id)->get('food_name');
       $menu_details = Menu::find($id)->menu()->where('status','Received')->get();
        $menu = Order::find($id);
        $menu_name = $menu->menu_name;
      return view('admin.filtered_menusales',compact('menusales_sum','adminmessage_count','menu_details','menu_name','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri')); 
    }

    // USER MANAGEMENT! 

    public function users(Request $request){
          $uri = request()->segment(2);

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

        $users = User::all();

        return view ('admin.user',compact('users','adminmessage_count','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
    }

    public function deactivate_account($id){
        User::where('id', $id)->update(['Account_Status'=>'Deactivated']);
        return back();
    }
    public function activate_account($id){
        User::where('id', $id)->update(['Account_Status'=>'Active']);   
        return back();
    }

    public function view_summary(Request $request,$id,$email){
        $uri = request()->segment(2);

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


        $orders= Order::where([
           'email' => $email,
           'order_id' => $id,
           'status' => 'Received'
           ])->get();
       $total= Order::where([
           'order_id' => $id,
           'status' => 'Received'
           ])->sum('menu_price');
       return view('admin.view_summary',compact('orders','adminmessage_count','total','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count','uri'));
   }


   public function decline_order(Request $request,$order_id,$email){
       //User::find($id)->notify(new UserNotification($message));

    //##########################################################################
    // ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
    // Visit www.itexmo.com/developers.php for more info about this API
    //##########################################################################
    function itexmo($number,$message,$apicode,$passwd){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }
    //##########################################################################

    $this->validate($request, [
        'message' => 'required',
        
    ]);

    $contact_number = $request->input('contactnumber');
    $txtmessage = $request->input('message');
    

    $result = itexmo($contact_number,$txtmessage,"TR-TESTI679121_G9XPQ", "igygk6y1)c");
            if ($result == ""){
              "iTexMo: No response from server!!!
            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
            Please CONTACT US for help. ";	
            }else if ($result == 0){
            
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

                    
                        $message = $request->input('message');
                        date_default_timezone_set('Asia/Manila');
                        $date = Carbon::now()->toDateTimeString();
                    
                        DB::table('message')->insert(
                            [
                            'to_useremail' => $email, 
                            'message' => $message,
                            'created_at' => $date]
                        );
                        $request->session()->flash('adminmessage_sent','Message Sent!');

                        
                        return redirect('/admin/pendingorders');
            }
            else{	
              "Error Num ". $result . " was encountered!";
            }
       
    
    
    /* Message::create($request->all()); */
   }
   public function receipts(Request $request){
      $uri = request()->segment(2);

    $users = DB::table('users')->where('is_admin','==',0)->get();
    $receipts = DB::table('receipts')->get();

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

    return view('admin.receipts',compact('users','receipts','adminmessage_count','approved_count','pending_count','inprocess_count','Ondelivery_count','received_count','uri'));
   }

   public function customer_receipts(Request $request,$user_id,$user_email)
   {
      $uri = request()->segment(2);

    $user = $user_email;
    $receipts = DB::table('receipts')->where('customer_id',$user_id)->orderby('created_at')->get();
    $admin_id = auth::user()->id;
        $adminmessage_count = DB::table('messages')->where([
           'to_id' => $admin_id,
           'seen' => 0
       ])->count();
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
    return view('admin.customer_receipts',compact('user','receipts','adminmessage_count','approved_count','pending_count','inprocess_count','Ondelivery_count','received_count','uri'));

   }

   public function view_receipt($receipt_name){
    $path = public_path('receipts/');
    $receiptname = $receipt_name;
    return response()->file($path.'/'.$receiptname);
   }

   public function generateReceipt(Request $request,$email,$id){
    $user = $email;
    $user_id = $id;
    $date = Carbon::now()->format('d-m-Y');
    $details =  DB::table('receiver_details')->where([
            ['transac_status','=','0'],
            ['fromemail','=', $email]
           ])->orderBy('created_at', 'desc')
           ->limit(1)->get();
/*      $details = DB::table('receiver_details')->where('fromemail',$email)->max('id')->get();
 */     $filtered_pendingorders = Order::where([
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
        'total_filtered_pendingorders' => $total_filtered_pendingorders,
        'details' => $details,
        'date' => $date
        ]);
   

    
    $path = public_path('receipts');
    $receipt_name = $date.'_'.$user.'receipt.pdf'; 

    /* DB::table('receipts')->insert(
        ['customer_id' => $user_id, 
        'receipt_name' => $receipt_name,
        'created_at' => $date
        ]
    );  */



    
     Receipt::firstOrCreate([
        'customer_id' => $user_id, 
        'receipt_name' => $receipt_name,
        
    ]); 

    $pdf->save($path.'/'.$receipt_name);
     $amount_paid = $request->input('amount_paid');
    User::where('id',$user_id)->update(['amount_paid' => $amount_paid]);
    
    return $pdf->download($date.'_'.$user.'receipt.pdf');
     
       //return view('receipt',compact('filtered_pendingorders','total_filtered_pendingorders','user'));

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
   /*  $messages = Message::where('from_useremail','!=',$admin_email)->get();
    $null = Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->count(); */
    date_default_timezone_set('Asia/Manila');
    $date = Carbon::now()->toDateTimeString();
/*     Message::where('from_useremail','!=',$admin_email)->whereNull('read_at')->update(['read_at' => $date]);   
 */
   
    return view('admin.messages',compact('messages','pending_count','approved_count','inprocess_count','Ondelivery_count','received_count',' '));
   }


   public function gcash_config(Request $request){
        $uri = request()->segment(2);
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
       $receivedorder_count = DB::table('receiver_details')
      ->where([
          'transac_status' => 1
          ])
      ->count();
       $cancelledorder_count = DB::table('receiver_details')
      ->where([
          'transac_status' => 'Cancelled'
          ])
      ->count();
       $pendingorder_count = DB::table('receiver_details')
      ->where([
          'transac_status' => 'Pending'
          ])
      ->count();
       $user_count = DB::table('users')
      ->count();
      
      
      $admin_id = auth::user()->id;
      $adminmessage_count = DB::table('messages')->where([
          'to_id' => $admin_id,
          'seen' => 0
      ])->count();


      $gcash = Gcash::where('id',1)->get();


        return view('admin.gcash',compact(
            'user_count','pending_count',
            'approved_count','inprocess_count',
            'Ondelivery_count','received_count',
            'receivedorder_count','cancelledorder_count',
            'pendingorder_count','adminmessage_count','uri','gcash'));
   }

   public function gcash_store(Request $request){
       $request->validate([
        'gcash_contactnumber' => 'required',
        'gcash_image' => 'required|mimes:jpg,jpeg'

    ]);

        $image = $request->file('gcash_image');
        echo $new_name = rand() . '.' .$image->getClientOriginalExtension();
        $image->move(public_path('images'),$new_name);

         $form_data = array(
            'gcash_contactnumber' => $request->gcash_contactnumber,
            'gcash_image' => $new_name
        );
/*         Gcash::firstOrCreate($form_data);
 */       
        $gcash = new Gcash;
        
        $gcash->gcash_contactnumber = request('gcash_contactnumber');
        $gcash->gcash_image = $new_name;
        $gcash->save();
/*         dd($gcash);
 */
        return redirect('/admin/gcash');
   }


   public function gcash_update(Request $request,$id){
   
    $request->validate([
        'gcash_contactnumber' => 'required',
        'gcash_image' => 'required|mimes:jpg,jpeg'
    ]);

    
     $gcash = Gcash::find($id);
    echo $gcash->gcash_contactnumber =$request->input('gcash_contactnumber');
    echo $gcash->gcash_image=$request->input('gcash_image');
   
    
    if($request->hasFile('gcash_image')){
        $image = $request->file('gcash_image');
        $filename = rand() . '.' .$image->getClientOriginalExtension();
        $location = public_path('images/'.$filename);
        $image->move(public_path('images'),$filename);
        
        $oldimage = $gcash->gcash_image;
        $gcash->gcash_image = $filename;
        Storage::delete($oldimage);
    }

    $gcash->save();
    return redirect('/admin/gcash');

}

}
