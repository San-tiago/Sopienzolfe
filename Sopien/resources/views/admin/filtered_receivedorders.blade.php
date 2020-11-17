
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Received Orders</h1>
        <a href="/admin/receivedorders"><button>Back</button></a>
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

        @foreach($filtered_receivedorders as $filtered_receivedorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_receivedorder->email}}</td>
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