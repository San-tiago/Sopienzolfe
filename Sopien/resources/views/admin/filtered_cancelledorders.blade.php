
@extends('layouts.admin_layout')
@section('dashboard')
<div>


<h1>Received Orders</h1>
        <a href="/admin/cancelledorders"><button class="btn btn-outline-secondary">Back</button></a>

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
     @foreach($filtered_cancelledorders as $filtered_cancelledorder)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_cancelledorder->menu_name}}</td>
            <td class="text-center">{{$filtered_cancelledorder->menu_category}}</td>
            <td class="text-center">{{$filtered_cancelledorder->menu_description}}</td>
            <td class="text-center">{{$filtered_cancelledorder->quantity}}</td>
            <td class="text-center">{{$filtered_cancelledorder->menu_price}}</td>  
        </tr>
        @endforeach
        
    </table>


    

</div>
@endsection