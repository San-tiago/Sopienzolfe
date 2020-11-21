
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Pending Orders</h1>
        <a href="/admin/pendingorders">
        <button type="button" class="btn btn-outline-secondary">Back</button>
        </a>
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
     @foreach($filtered_pendingorders as $filtered_pendingorder)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_name}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_category}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_description}}</td>
            <td class="text-center">{{$filtered_pendingorder->quantity}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_price}}</td>  
        </tr>
        @endforeach
        <a href="{{url('/admin/approving-order/'.$filtered_pendingorder->email)}}">
        <button type="button" class="btn btn-outline-primary">Approve Order</button>
        </a>
    </tbody>
    </table>



    

</div>
@endsection