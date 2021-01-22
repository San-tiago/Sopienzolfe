@extends('layouts.dashboard')

@section('dashboard')
<div >

<div class="d-flex p-2 d-flex justify-content-center table-bordered"><h1>Received Orders Summary</h1></div>

        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col" class="text-center">Food Name</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Price</th>
                </tr>
                </thead>
             <tbody>

      
        @foreach($orders as $order)
                    <tr>
                   
                        <td class="text-center">{{$order->menu_name}}</td>
                        <td class="text-center">{{$order->menu_category}}</td>
                        <td class="text-center">{{$order->menu_description}}</td>
                        <td class="text-center">{{$order->quantity}}</td>
                        <td class="text-center">{{$order->menu_price}}</td>  
                    </tr>
                    @endforeach

                    </tbody>
                </table>

</table>

    <div class="d-flex p-2 d-flex justify-content-center table-bordered"><h1 name="total">Total:{{$total}}</h1>
    </div>
</div>





</div>
@endsection