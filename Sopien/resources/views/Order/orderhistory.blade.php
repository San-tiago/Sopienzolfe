@extends('layouts.menu')

@section('content')
<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Order History</h1>
				</div>
			</div>
		</div>
	</div>
<div >


        <table class="table table-bordered mt-5">
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
                <td class="text-center">{{date('d-m-Y', strtotime($orderhistory->created_at. '+3 days'))}}</td>
                <td class="text-center">
                    <a href="{{url('/view/history-orders/'.$orderhistory->id.'/'.$orderhistory->fromemail)}}">
                        <button type="button" class="btn btn-primary">View</button>
                    </a>
                </td>
            </tr>
         @endforeach

                </tbody>
            </table>

</table>

   

@endsection