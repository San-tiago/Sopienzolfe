
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Approve Orders</h1>
        <a href="/admin/approvedorders"><button class="btn btn-outline-secondary">Back</button></a>
<table class="table table-bordered">
     <thead>
         <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Food Name</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Price</th>
        </tr>
    </thead>
     <tbody>
     @foreach($filtered_approveorders as $filtered_approveorder)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_approveorder->menu_name}}</td>
            <td class="text-center">{{$filtered_approveorder->menu_category}}</td>
            <td class="text-center">{{$filtered_approveorder->menu_description}}</td>
            <td class="text-center">{{$filtered_approveorder->quantity}}</td>
            <td class="text-center">{{$filtered_approveorder->menu_price}}</td>  
        </tr>
        
        @endforeach
        <a href="{{url('/admin/processing-order/'.$filtered_approveorder->email)}}">
        <button class="btn btn-outline-primary">Process Order</button>
        </a>    
    </tbody>
    </table>



    

</div>
@endsection