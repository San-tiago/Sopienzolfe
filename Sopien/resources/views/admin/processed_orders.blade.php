
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Process Orders</h1>
    
        <a href="/admin/processedorders"><button>All</button></a><br>
        @foreach($users as $user)
        <a href="{{url('/admin/process-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
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

        @foreach($processed_orders as $processed_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$processed_order->email}}</td>
            <td>{{$processed_order->menu_name}}</td>
            <td>{{$processed_order->menu_category}}</td>
            <td>{{$processed_order->menu_description}}</td>
            <td>{{$processed_order->quantity}}</td>
            <td>{{$processed_order->menu_price}}</td>  
        </tr>
        @endforeach

</table>


    

</div>
@endsection