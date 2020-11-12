
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Approve Orders</h1>
    
        <a href="/admin/approveorders"><button>All</button></a><br>

        @foreach($users as $user)
        <a href="{{url('/admin/approve-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
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

        @foreach($approved_orders as $approved_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$approved_order->email}}</td>
            <td>{{$approved_order->menu_name}}</td>
            <td>{{$approved_order->menu_category}}</td>
            <td>{{$approved_order->menu_description}}</td>
            <td>{{$approved_order->quantity}}</td>
            <td>{{$approved_order->menu_price}}</td>  
        </tr>
        @endforeach

</table>


    

</div>
@endsection