
@extends('layouts.dashboard')

@section('dashboard')

<h1>Approve Orders</h1>
<div class="main-section">
    <div>
    <h4>From :</h4>
        <a href="/admin/approveorders"><button>All</button></a><br>
        @foreach($users as $user)
        <a href="{{url('/admin/approve-order/'.$user->email)}}"><button>{{$user->email}}</button></a><br>
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
     @foreach($approved_orders as $approved_order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$approved_order->menu_name}}</td>
            <td>{{$approved_order->menu_category}}</td>
            <td>{{$approved_order->menu_description}}</td>
            <td>{{$approved_order->quantity}}</td>
            <td>{{$approved_order->menu_price}}</td>  
        </tr>
        @endforeach

        </tbody>
     </table>
    </div>
</div>

    


@endsection