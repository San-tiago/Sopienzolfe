
@extends('layouts.menu')

@section('content')
<div class="d-flex justify-content-center"><h1>Your Cancelled Orders</h1></div>

<div class="main-section">
    
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
            <th class="text-center" scope="col">Date</th>
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