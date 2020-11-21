
@extends('layouts.dashboard')

@section('dashboard')
<h1>On Delivery Orders</h1>
<div class="main-section">
    <div>
    <h4>From :</h4>
        @foreach($users as $user)
        <a href="{{url('/admin/ondelivery-order/'.$user->email)}}" class ="orders-link">
        <button type="button" class="btn btn-light">{{$user->email}}</button>
        </a><br>
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
    
     @foreach($ondelivery_orders as $ondelivery_order)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$ondelivery_order->menu_name}}</td>
            <td class="text-center">{{$ondelivery_order->menu_category}}</td>
            <td class="text-center">{{$ondelivery_order->menu_description}}</td>
            <td class="text-center">{{$ondelivery_order->quantity}}</td>
            <td class="text-center">{{$ondelivery_order->menu_price}}</td>  
        </tr>
        @endforeach

        </tbody>
     </table>
    </div>
    

</div>
@endsection