
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Pending Orders</h1>
    <p>Filter by G-mal: </p> <select name="" id=""></select>
    <table>
        <tr>
           <th>id</th>
            <th>From</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Date</th>
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
            <td>{{$pending_order->status}}</td>
            <td>{{$pending_order->created_at}}</td>
            <td><a href="{{url('/admin/approve-order/'.$pending_order->id)}}"><button>Approve</button></a></td>
        </tr>
        @endforeach

</table>


    

</div>
@endsection