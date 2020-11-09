<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h1>View Order</h1>
    <a href="{{url('/admin/view-pendingorders')}}"><button>Pending Orders</button></a>
    <a href="{{url('/admin/view-ongoingorders')}}"><button>On Going Orders</button></a>
    <a href="{{url('/admin/view-receivedorders')}}"><button>Received Orders</button></a>
    <a href="{{url('/admin/view-receivedorders')}}"><button>Canceled Orders</button></a>
    <table>
        <tr>
           <th>id</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Date</th>
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
            <td>{{$order->created_at}}</td>
            <td><a href="{{url('/admin/approve-order/'.$order->id)}}"><button>Approve</button></a></td>
            
        </tr>
        @endforeach

</table>
</body>
</html>