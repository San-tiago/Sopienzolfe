
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Process Orders</h1>
        <a href="/admin/processedorders"><button>Back</button></a>
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
     @foreach($filtered_processorders as $filtered_processorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_processorder->menu_name}}</td>
            <td>{{$filtered_processorder->menu_category}}</td>
            <td>{{$filtered_processorder->menu_description}}</td>
            <td>{{$filtered_processorder->quantity}}</td>
            <td>{{$filtered_processorder->menu_price}}</td>  
        </tr>
        @endforeach
        <a href="{{url('/admin/delivering-order/'.$filtered_processorder->email)}}"><button>Deliver Order</button></a>
    </table>



    

</div>
@endsection