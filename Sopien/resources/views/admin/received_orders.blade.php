
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Received Order</h1>
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

        @foreach($received_orders as $received_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$received_order->email}}</td>
            <td>{{$received_order->menu_name}}</td>
            <td>{{$received_order->menu_category}}</td>
            <td>{{$received_order->menu_description}}</td>
            <td>{{$received_order->quantity}}</td>
            <td>{{$received_order->menu_price}}</td>
            <td>{{$received_order->status}}</td>
            <td>{{$received_order->created_at}}</td>
            
        </tr>
        @endforeach

</table>


    

</div>
@endsection