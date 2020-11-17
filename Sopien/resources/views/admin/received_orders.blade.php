
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Received Orders</h1>
    
        <a href="/admin/processedorders"><button>All</button></a><br>
        @foreach($users as $user)
        <a href="{{url('/admin/received-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
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

        @foreach($received_orders as $received_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$received_order->user_email}}</td>
            <td>{{$received_order->menu_name}}</td>
            <td>{{$received_order->menu_category}}</td>
            <td>{{$received_order->menu_description}}</td>
            <td>{{$received_order->quantity}}</td>
            <td>{{$received_order->menu_price}}</td>  
        </tr>
        @endforeach

</table>


    

</div>
@endsection