
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>On Delivery Orders</h1>
        <a href="/admin/ondeliveryorders"><button>Back</button></a>
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

        @foreach($filtered_ondeliveryorders as $filtered_ondeliveryorder)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$filtered_ondeliveryorder->email}}</td>
            <td>{{$filtered_ondeliveryorder->menu_name}}</td>
            <td>{{$filtered_ondeliveryorder->menu_category}}</td>
            <td>{{$filtered_ondeliveryorder->menu_description}}</td>
            <td>{{$filtered_ondeliveryorder->quantity}}</td>
            <td>{{$filtered_ondeliveryorder->menu_price}}</td>  
        </tr>

        @endforeach
        <a href="{{url('/admin/receiving-order/'.$filtered_ondeliveryorder->email)}}"><button>Mark as Received</button></a>
        
       
</table>



    

</div>
@endsection