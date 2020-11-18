
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Approve Orders</h1>
        <a href="/admin/approvedorders"><button>Back</button></a>
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
     @foreach($filtered_approveorders as $filtered_approveorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_approveorder->menu_name}}</td>
            <td>{{$filtered_approveorder->menu_category}}</td>
            <td>{{$filtered_approveorder->menu_description}}</td>
            <td>{{$filtered_approveorder->quantity}}</td>
            <td>{{$filtered_approveorder->menu_price}}</td>  
        </tr>
        
        @endforeach
        <a href="{{url('/admin/processing-order/'.$filtered_approveorder->email)}}"><button>Process Order</button></a>    </tbody>
    </table>



    

</div>
@endsection