
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Approve Orders</h1>
        <a href="/admin/pendingorders"><button>Back</button></a>
    <table>
        <tr>
           <th>id</th>
           <th>From</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>

        @foreach($filtered_approveorders as $filtered_approveorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_approveorder->email}}</td>
            <td>{{$filtered_approveorder->menu_name}}</td>
            <td>{{$filtered_approveorder->menu_category}}</td>
            <td>{{$filtered_approveorder->menu_description}}</td>
            <td>{{$filtered_approveorder->quantity}}</td>
            <td>{{$filtered_approveorder->menu_price}}</td>  
        </tr>
        
        @endforeach
        <a href="{{url('/admin/processing-order/'.$filtered_approveorder->email)}}"><button>Process Order</button></a>

       
</table>



    

</div>
@endsection