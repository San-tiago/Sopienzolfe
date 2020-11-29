
@extends('layouts.dashboard')

@section('dashboard')
<div class="d-flex justify-content-center table-bordered"><h1>Cancelled Orders</h1></div>

<div class="main-section">
    <div>
    <h4>From :</h4>
        @foreach($users as $user)
        <a href="{{url('/admin/customer-cancelled-order/'.$user->id)}}" class ="orders-link">
            <button type="button" class="btn btn-light">{{$user->email}}</button>
        </a><br>
        @endforeach
    </div>


    <div class="info-section">
    <div class="d-flex justify-content-center table-bordered"><h3>All</h3></div>
        <table class="table table-bordered">
        <thead>
         <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Food Name</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Price</th>
            <th scope="col" class="text-center">Date</th>
        </tr>
        </thead>
     <tbody>
     @foreach($cancelled_orders as $cancelled_order)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$cancelled_order->menu_name}}</td>
            <td class="text-center">{{$cancelled_order->menu_category}}</td>
            <td class="text-center">{{$cancelled_order->menu_description}}</td>
            <td class="text-center">{{$cancelled_order->quantity}}</td>
            <td class="text-center">{{$cancelled_order->menu_price}}</td>  
            <td class="text-center">{{$cancelled_order->created_at}}</td>  
        </tr>
        @endforeach

        </tbody>
     </table>
    </div>
</div>

    


@endsection