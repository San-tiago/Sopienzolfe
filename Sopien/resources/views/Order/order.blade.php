<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
<h1>MY ORDERS</h1>

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
<div class="Details">
Receiver Name: <input name = "receiver_name" type="text" placeholder="Fullname"><br>
Address : <input name= "address" type="text" placeholder="Address">
Contact Number: <input type="text" name="contactnumber">
</div>

<h1 name="total">

Total:{{$total}}

</h1>
<a href="/placedorder"><button>Place Order</button></a>

    

</div>
</body>
</html>