
@extends('layouts.dashboard')

@section('dashboard')
<h1>Process Orders</h1>
<div class="main-section">
    <div>
        <h4>From :</h4>
        <a href="/admin/processedorders"><button>All</button></a><br>
        @foreach($users as $user)
        <a href="{{url('/admin/process-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
        @endforeach
    </div>

    <div class="info-section">
        <table class="table table-bordered">
        <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">Food Name</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
     <tbody>
     @foreach($processed_orders as $processed_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$processed_order->menu_name}}</td>
            <td>{{$processed_order->menu_category}}</td>
            <td>{{$processed_order->menu_description}}</td>
            <td>{{$processed_order->quantity}}</td>
            <td>{{$processed_order->menu_price}}</td>  
        </tr>
        @endforeach

        </tbody>
     </table>
    </div>

    

</div>
@endsection