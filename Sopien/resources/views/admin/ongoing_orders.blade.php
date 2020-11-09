
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Ongoing Order</h1>
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

        @foreach($ongoing_orders as $ongoing_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$ongoing_order->email}}</td>
            <td>{{$ongoing_order->menu_name}}</td>
            <td>{{$ongoing_order->menu_category}}</td>
            <td>{{$ongoing_order->menu_description}}</td>
            <td>{{$ongoing_order->quantity}}</td>
            <td>{{$ongoing_order->menu_price}}</td>
            <td>{{$ongoing_order->status}}</td>
            <td>{{$ongoing_order->created_at}}</td>
            <td><a href="{{url('/admin/received-order/'.$ongoing_order->id)}}"><button>Mark as Received</button></a></td>
        </tr>
        @endforeach

</table>


    

</div>
@endsection