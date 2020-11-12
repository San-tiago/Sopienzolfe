
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Pending Orders</h1>
    
        <a href="/admin/pendingorders"><button>All</button></a><br>
        @foreach($users as $user)
        <a href="{{url('/admin/pending-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
        @endforeach
 
    <table>
        <tr>
           <th>id</th>
           <th>From</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>

        @foreach($pending_orders as $pending_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$pending_order->email}}</td>
            <td>{{$pending_order->menu_name}}</td>
            <td>{{$pending_order->menu_category}}</td>
            <td>{{$pending_order->menu_description}}</td>
            <td>{{$pending_order->quantity}}</td>
            <td>{{$pending_order->menu_price}}</td>  
        </tr>
        @endforeach

</table>


    

</div>
@endsection