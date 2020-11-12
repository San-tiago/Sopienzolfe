<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
<h1>Order List</h1>

<a href="/home"><button>Back</button></a>

<table>
        <tr>
           <th>id</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>

        @foreach($orders as $order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$order->menu_name}}</td>
            <td>{{$order->menu_category}}</td>
            <td>{{$order->menu_description}}</td>
            <td>{{$order->quantity}}</td>
            <td>{{$order->menu_price}}</td>
            <td><a href="{{url('order/delete/'.$order->id)}}">  Remove</a></td>
            
        </tr>
        @endforeach

</table>
<br>

<h1 name="total">
Total:{{$total}}
</h1>
<a href="{{url('/placeorder')}}"><button>Check Out</button></a>

</div>
</body>
</html>