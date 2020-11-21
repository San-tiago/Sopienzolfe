
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Received Orders</h1>
        <a href="/admin/receivedorders"><button class="btn btn-outline-secondary">Back</button></a>

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
     @foreach($filtered_receivedorders as $filtered_receivedorder)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_receivedorder->menu_name}}</td>
            <td class="text-center">{{$filtered_receivedorder->menu_category}}</td>
            <td class="text-center">{{$filtered_receivedorder->menu_description}}</td>
            <td class="text-center">{{$filtered_receivedorder->quantity}}</td>
            <td class="text-center">{{$filtered_receivedorder->menu_price}}</td>  
        </tr>
        @endforeach
        
    </table>


    

</div>
@endsection