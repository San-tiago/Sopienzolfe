
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Pending Orders</h1>
        <a href="/admin/pendingorders"><button>Back</button></a>
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
     @foreach($filtered_pendingorders as $filtered_pendingorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_pendingorder->menu_name}}</td>
            <td>{{$filtered_pendingorder->menu_category}}</td>
            <td>{{$filtered_pendingorder->menu_description}}</td>
            <td>{{$filtered_pendingorder->quantity}}</td>
            <td>{{$filtered_pendingorder->menu_price}}</td>  
        </tr>
        @endforeach
        <a href="{{url('/admin/approving-order/'.$filtered_pendingorder->email)}}"><button>Approve</button></a>
    </tbody>
    </table>



    

</div>
@endsection