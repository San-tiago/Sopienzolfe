
@extends('layouts.dashboard')

@section('dashboard')

<h1>Received Orders</h1>

<div class="main-section ">
    
    <div class="email-section">
        <h4>From :</h4>
        @foreach($users as $user)
        <a href="{{url('/admin/received-order/'.$user->id)}}" class ="orders-link"><button type="button" class="btn btn-light">{{$user->email}}</button></a>
        @endforeach
        
</div>   

<div class="info-section">
        <table class="table table-bordered">
        <thead>
         <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Food Name</th>
            <th class="text-center" scope="col">Category</th>
            <th class="text-center" scope="col">Description</th>
            <th class="text-center" scope="col">Quantity</th>
            <th class="text-center" scope="col">Price</th>
        </tr>
        </thead>
     <tbody>
     @foreach($received_orders as $received_order)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$received_order->menu_name}}</td>
            <td class="text-center">{{$received_order->menu_category}}</td>
            <td class="text-center">{{$received_order->menu_description}}</td>
            <td class="text-center">{{$received_order->quantity}}</td>
            <td class="text-center">{{$received_order->menu_price}}</td>  
        </tr>
        @endforeach

        </tbody>
     </table>
    </div>
    

</div>
@endsection