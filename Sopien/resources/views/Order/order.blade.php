@extends('layouts.menu')

@section('content')
<div >
<a href="/home"><button button type="button" class="btn btn-primary">Back</button></a>

<div class="d-flex p-2 d-flex justify-content-center table-bordered"><h1>Order List</h1></div>

        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Food Name</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Action</th>
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
                        <td class="text-center"><a href="{{url('order/delete/'.$order->id)}}"><button type="button" class="btn btn-danger">Remove</button></a></td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>

</table>
@if($total > 0)
    <div class="d-flex p-2 d-flex justify-content-center"><h1 name="total">Total:{{$total}}</h1>
    </div>
    <div class="d-flex p-2 d-flex justify-content-center"><a href="{{url('/placeorder')}}">
            <button type="button" class="btn btn-success">Check Out</button></a>
    </div>
@else
    <div class="d-flex p-2 d-flex justify-content-center">
        <a href="/receiver_page">
            <button type="button" class="btn btn-primary">Click here to Create Order
            </button>
        </a>
    </div>
@endif





</div>
@endsection