
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>On Delivery Orders</h1>
    
        <a href="/admin/approveorders"><button>All</button></a><br>

        @foreach($users as $user)
        <a href="{{url('/admin/ondelivery-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
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

        @foreach($ondelivery_orders as $ondelivery_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$ondelivery_order->email}}</td>
            <td>{{$ondelivery_order->menu_name}}</td>
            <td>{{$ondelivery_order->menu_category}}</td>
            <td>{{$ondelivery_order->menu_description}}</td>
            <td>{{$ondelivery_order->quantity}}</td>
            <td>{{$ondelivery_order->menu_price}}</td>  
        </tr>
        @endforeach

</table>


    

</div>
@endsection