
@extends('layouts.dashboard')

@section('dashboard')

<h1>Approve Orders</h1>
<div class="main-section">
    <div>
    <h4>From :</h4>
        @foreach($users as $user)
        <a href="{{url('/admin/approve-order/'.$user->email)}}" class ="orders-link">
            <button type="button" class="btn btn-light">{{$user->email}}</button>
        </a><br>
        @endforeach
    </div>


    <div class="info-section">
        <table class="table table-bordered">
        <thead>
         <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Food Name</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Price</th>
        </tr>
        </thead>
     <tbody>
     @foreach($approved_orders as $approved_order)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$approved_order->menu_name}}</td>
            <td class="text-center">{{$approved_order->menu_category}}</td>
            <td class="text-center">{{$approved_order->menu_description}}</td>
            <td class="text-center">{{$approved_order->quantity}}</td>
            <td class="text-center">{{$approved_order->menu_price}}</td>  
        </tr>
        @endforeach

        </tbody>
     </table>
    </div>
</div>

    


@endsection