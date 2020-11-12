
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Process Orders</h1>
        <a href="/admin/processedorders"><button>Back</button></a>
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

        @foreach($filtered_processorders as $filtered_processorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_processorder->email}}</td>
            <td>{{$filtered_processorder->menu_name}}</td>
            <td>{{$filtered_processorder->menu_category}}</td>
            <td>{{$filtered_processorder->menu_description}}</td>
            <td>{{$filtered_processorder->quantity}}</td>
            <td>{{$filtered_processorder->menu_price}}</td>  
        </tr>
        <a href="{{url('/admin/delivering-order/'.$filtered_processorder->email)}}"><button>Deliver Order</button></a>
        @endforeach
        

       
</table>



    

</div>
@endsection