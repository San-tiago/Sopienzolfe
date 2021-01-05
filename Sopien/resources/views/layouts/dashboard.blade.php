<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="/css/admin.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/114bfafc96.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="sidebar">
                         
                      
    <a href="/admin/menu"><i class="fas fa-calendar-minus fa-lg icon"></i>Menu</a><br>
    <a href="/admin/pendingorders"><span class="badge badge-danger ">
            {{$pending_count ?? ''}}
        </span><i class="fas fa-clock fa-lg icon"></i>Pending Orders</a><br>
    <a href="/admin/approvedorders"> <span class="badge badge-danger ">
            {{$approved_count ?? ''}}
            </span>
        <i class="fas fa-calendar-check fa-lg icon"></i>Approve Orders
    </a><br>
    <a href="/admin/processedorders"><span class="badge badge-danger ">
            {{$inprocess_count ?? ''}}      
            </span><i class="fas fa-spinner fa-lg icon"></i>Processed Orders</a><br>
    <a href="/admin/ondeliveryorders"><span class="badge badge-danger ">{{$Ondelivery_count ?? ''}} </span><i class="fas fa-truck fa-lg icon"></i>On Delivery Orders</a><br>
    <a href="/admin/receivedorders"><span class="badge badge-danger ">{{$received_count ?? ''}}</span><i class="fas fa-tasks fa-lg icon"></i>Received Orders</a><br>
    <a href="/admin/cancelledorders"><i class="far fa-window-close fa-lg icon"></i>Cancelled Orders</a><br>
    <a href="/admin/sales"><i class="fas fa-file-invoice-dollar fa-lg icon"></i>Sales</a><br>
    <a href="/admin/users"><i class="fas fa-users fa-lg icon"></i>Users</a><br>
    <a href="/admin/users"><i class="fas fa-book fa-lg icon"></i>Guide</a><br>
    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> 

</div>
<main class="content">
            @yield('dashboard')
</main>

<script>
   function approve_order(){
       const notification = new Notification("ORDER MARK AS APPROVED!",{
           body:"Check approved orders button"
       })
   }
        
       
   function process_order(){
       const notification = new Notification("ORDER MARK AS PROCESSED!",{
           body:"Check in-process order button"
       })
   }
        
   function deliver_order(){
       const notification = new Notification("ORDER MARK AS ON-DELIVERY!",{
           body:"Check on-deliver order button"
       })
   }
   function received_order(){
       const notification = new Notification("ORDER MARK AS RECEIVED!",{
           body:"Check received order button"
       })
   }

   </script>
</body>
</html>