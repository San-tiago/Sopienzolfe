
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Pending Orders</h1>
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

        @foreach($filtered_pendingorders as $filtered_pendingorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_pendingorder->email}}</td>
            <td>{{$filtered_pendingorder->menu_name}}</td>
            <td>{{$filtered_pendingorder->menu_category}}</td>
            <td>{{$filtered_pendingorder->menu_description}}</td>
            <td>{{$filtered_pendingorder->quantity}}</td>
            <td>{{$filtered_pendingorder->menu_price}}</td>  
        </tr>
        @endforeach
        <a href="{{url('/admin/approving-order/'.$filtered_pendingorder->email)}}"><button>Approve</button></a>

       
</table>



    

</div>
@endsection