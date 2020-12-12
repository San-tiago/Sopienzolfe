
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Process Orders</h1>
        <a href="/admin/processedorders"><button class="btn btn-outline-secondary">Back</button></a>
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
     @foreach($filtered_processorders as $filtered_processorder)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_processorder->menu_name}}</td>
            <td class="text-center">{{$filtered_processorder->menu_category}}</td>
            <td class="text-center">{{$filtered_processorder->menu_description}}</td>
            <td class="text-center">{{$filtered_processorder->quantity}}</td>
            <td class="text-center">{{$filtered_processorder->menu_price}}</td>  
        </tr>
        @endforeach
        <a href="{{url('/admin/delivering-order/'.$filtered_processorder->email)}}"><button class="btn btn-outline-primary">Deliver Order</button></a>
    </table>

    <div class="d-flex p-2 d-flex justify-content-center"><h1 name="total">Total: P {{$total_filtered_processorders}}</h1>
    </div>

    

</div>
@endsection