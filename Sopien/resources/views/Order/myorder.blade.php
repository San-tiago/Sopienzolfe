@extends('layouts.app')

@section('content')
<div>

<div class="container">
<div class="d-flex p-2 d-flex justify-content-center table-bordered"> <h1>Order Status</h1></div>
    <div class="d-flex p-2 d-flex justify-content-center table-bordered d-flex justify-content-around">
         <div>
            <p>Pending</p>
        </div>
        <div>
             <p>Order Approve</p>
         </div>
        <div>
             <p>Order Processed</p>
        </div>
        <div>
             <p>On Delivery</p>
        </div>
    </div>

   <div class="d-flex p-2 d-flex justify-content-center table-bordered"> <h1>Order Summary</h1></div>
  
  @if(!$orders->isEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Food Name</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Status</th>
                </tr>
                </thead>
             <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="text-center">{{$loop->index+1}}</td>
                        <td class="text-center">{{$order->menu_name}}</td>
                        <td class="text-center">{{$order->menu_category}}</td>
                        <td class="text-center">{{$order->menu_description}}</td>
                        <td class="text-center">{{$order->quantity}}</td>
                        <td class="text-center">{{$order->menu_price}}</td>  
                        <td class="text-center">{{$order->status}}</td>  
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                <a href="{{url('/cancel-order/'.Auth::user()->email)}}"> <button type="button" class="btn btn-outline-danger">Cancel Orders</button></a>
@else
<div class="card text-center mt-md-3">

        <div class="card-body ">
            <h5 class="card-title"></h5>
            <p class="h2">You have no Order</p>
            <a href="/home" class="btn btn-primary">Click here to Order</a>
        </div>
</div>
@endif
</div>
@endsection
