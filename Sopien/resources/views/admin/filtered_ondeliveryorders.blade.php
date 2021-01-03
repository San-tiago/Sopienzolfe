
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>On Delivery Orders</h1>
        <a href="/admin/ondeliveryorders"><button class="btn btn-outline-secondary">Back</button></a>
        <table class="table table-bordered">
     <thead>
         <tr>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Receiver Name</th>
            <th scope="col" class="text-center">Address</th>
            <th scope="col" class="text-center">Municipality / City</th>
            <th scope="col" class="text-center">Province / Region</th>
            <th scope="col" class="text-center">Contact Number</th>
        </tr>
    </thead>
     <tbody>

        <tr>
            <td class="text-center">{{$details['fromemail']}}</td>
            <td class="text-center">{{$details['receivername']}}</td>
            <td class="text-center">{{$details['receiveraddress']}}</td>
            <td class="text-center">{{$details['municipality/city']}}</td>
            <td class="text-center">{{$details['province']}}</td>
            <td class="text-center">{{$details['receivercontactnumber']}}</td>  
        </tr>
   
    </tbody>
    </table>
<table class="table table-bordered">
     <thead>
         <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Food Name</th>
            <th class="text-center" scope="col">Category</th>
            <th class="text-center" scope="col">Description</th>
            <th class="text-center" scope="col">Quantity</th>
            <th class="text-center" scope="col">Price</th>
        </tr>
    </thead>
     <tbody>
    @foreach($filtered_ondeliveryorders as $filtered_ondeliveryorder)

        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_ondeliveryorder->menu_name}}</td>
            <td class="text-center">{{$filtered_ondeliveryorder->menu_category}}</td>
            <td class="text-center">{{$filtered_ondeliveryorder->menu_description}}</td>
            <td class="text-center">{{$filtered_ondeliveryorder->quantity}}</td>
            <td class="text-center">{{$filtered_ondeliveryorder->menu_price}}</td>  
        </tr>
    @endforeach
        <a href="{{url('/admin/receiving-order/'.$filtered_ondeliveryorder->email.'/'.$details['id'])}}">
         <button class="btn btn-outline-primary" onclick="received_order() ">Mark as Received</button>
        </a>
    </table>

    <div class="d-flex p-2 d-flex justify-content-center"><h1 name="total">Total: P {{$total_filtered_ondeliveryorders}}</h1>
    </div>

</div>
@endsection