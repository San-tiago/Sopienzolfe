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
<div class="container">
   
    <table>
        <tr>
           <th>id</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>

        </tr>

        @foreach($orders as $order)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$order->menu_name}}</td>
            <td>{{$order->menu_category}}</td>
            <td>{{$order->menu_description}}</td>
            <td>{{$order->quantity}}</td>
            <td>{{$order->menu_price}}</td>
            <td>{{$order->status}}</td>

        </tr>
        @endforeach

</table>
  
</div>
</body>
</html>
