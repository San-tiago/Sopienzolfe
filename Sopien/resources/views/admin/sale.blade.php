@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Sales</h1>

<h1>Today</h1>
<h3>{{$totalsales_today}}</h3>
<table>
        <tr>
           <th>id</th>
            <th>Email</th>
            <th>Food Item</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        
        @foreach($orders_today as $order_today)
        <tr>

            <td>{{$loop->index+1}}</td>
            <td>{{$order_today->email}}</td>       
            <td>{{$order_today->menu_name}}</td>       
            <td>{{$order_today->menu_category}}</td>       
            <td>{{$order_today->quantity}}</td>       
            <td>{{$order_today->menu_price}}</td>      
        </tr>
        @endforeach

</table><br>


<h1>Month</h1>
<h3>{{$totalsales_monthly}}</h3>
<table>
        <tr>
           <th>id</th>
            <th>Email</th>
            <th>Food Item</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        
        @foreach($orders_month as $order_month)
        <tr>

            <td>{{$loop->index+1}}</td>
            <td>{{$order_month->email}}</td>       
            <td>{{$order_month->menu_name}}</td>       
            <td>{{$order_month->menu_category}}</td>       
            <td>{{$order_month->quantity}}</td>       
            <td>{{$order_month->menu_price}}</td>      
        </tr>
        @endforeach

</table>
    

</div>
@endsection