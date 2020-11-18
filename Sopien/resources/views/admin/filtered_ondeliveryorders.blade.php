
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>On Delivery Orders</h1>
        <a href="/admin/ondeliveryorders"><button>Back</button></a>
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
     @foreach($filtered_ondeliveryorders as $filtered_ondeliveryorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_ondeliveryorder->menu_name}}</td>
            <td>{{$filtered_ondeliveryorder->menu_category}}</td>
            <td>{{$filtered_ondeliveryorder->menu_description}}</td>
            <td>{{$filtered_ondeliveryorder->quantity}}</td>
            <td>{{$filtered_ondeliveryorder->menu_price}}</td>  
        </tr>

        @endforeach
        <a href="{{url('/admin/receiving-order/'.$filtered_ondeliveryorder->email)}}"><button>Mark as Received</button></a>
    </table>

    

</div>
@endsection