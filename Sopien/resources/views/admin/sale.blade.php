@extends('layouts.dashboard')

@section('dashboard')

<div>
    <h1>Sales</h1>
    <div class="main-sales-container">
        <div class="today-sales">
        <h1>Today Sales</h1>
        <h3>{{$totalsales_today}}</h3>
    </div>
    
    <div class="monthly-sales">
        <h1>Month Sales</h1>
        <h3>{{$totalsales_monthly}}</h3>
    </div>
</div>
    <div>
        <h1>Menu</h1>
        @foreach($menus as $menu)
        <a href="{{url('/menu/sales/'.$menu->id)}}"><button>{{$menu->food_name}}</button></a> <br>
        @endforeach
    </div>
</div>

<div>
<h1>Today Sales</h1>
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

<h1>Monthly Sales</h1>
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