
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Received Orders</h1>
        <a href="/admin/receivedorders"><button>Back</button></a>

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
     @foreach($filtered_receivedorders as $filtered_receivedorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_receivedorder->menu_name}}</td>
            <td>{{$filtered_receivedorder->menu_category}}</td>
            <td>{{$filtered_receivedorder->menu_description}}</td>
            <td>{{$filtered_receivedorder->quantity}}</td>
            <td>{{$filtered_receivedorder->menu_price}}</td>  
        </tr>
        @endforeach
        
    </table>


    

</div>
@endsection