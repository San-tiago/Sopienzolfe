
@extends('layouts.dashboard')

@section('dashboard')
<div>


<h1>Received Orders</h1>
        <a href="/admin/receivedorders"><button class="btn btn-outline-secondary">Back</button></a>

        <table class="table table-bordered">
            <thead>
                <tr>
               
               
                <th scope="col" class="text-center">Received by</th>
                <th scope="col" class="text-center">Address</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Order Summary</th>
                </tr>
                </thead>
             <tbody>

      
        @foreach($order_history as $orderhistory)
            <tr>
                <td class="text-center">{{$orderhistory->receivername}}</td>
                <td class="text-center">{{$orderhistory->receiveraddress}}</td>
                <td class="text-center">{{date('d-m-Y', strtotime($orderhistory->created_at))}}</td>
                <td class="text-center">
                    <a href="{{url('/view/summary-orders/'.$orderhistory->id.'/'.$orderhistory->fromemail)}}">
                        <button type="button" class="btn btn-primary">View</button>
                    </a>
                </td>
            </tr>
         @endforeach

                </tbody>
            </table>


    
    </div>

</div>
@endsection