
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Pending Orders</h1>
        <a href="/admin/pendingorders">
        <button type="button" class="btn btn-outline-secondary">Back</button>
        </a>
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
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Food Name</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Price</th>
        </tr>
    </thead>
     <tbody>
     @foreach($filtered_pendingorders as $filtered_pendingorder)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_name}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_category}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_description}}</td>
            <td class="text-center">{{$filtered_pendingorder->quantity}}</td>
            <td class="text-center">{{$filtered_pendingorder->menu_price}}</td>  
        </tr>
        @endforeach
        <a href="{{url('/admin/approving-order/'.$filtered_pendingorder->email)}}">
        <button type="button" class="btn btn-outline-primary" onclick="approve_order()">Approve Order</button>
        </a>
    </tbody>
    </table>

    <div class="d-flex p-2 d-flex justify-content-center"><h1 name="total">Total: P {{$total_filtered_pendingorders}}</h1>
    </div>

    

</div>
@endsection