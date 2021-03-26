@extends('layouts.menu')

@section('content')
<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Cancelled Order History</h1>
				</div>
			</div>
		</div>
	</div>
<div >

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

      
        @foreach($cancelled_order_history as $cancelled_order)
            <tr>
                <td class="text-center">{{$cancelled_order->receivername}}</td>
                <td class="text-center">{{$cancelled_order->receiveraddress}}</td>
                <td class="text-center">{{date('d-m-Y', strtotime($cancelled_order->created_at))}}</td>
                <td class="text-center">
                    <a href="{{url('/view/cancelled-orders/'.$cancelled_order->id.'/'.$cancelled_order->fromemail)}}">
                        <button type="button" class="btn btn-primary">View</button>
                    </a>
                </td>
            </tr>
         @endforeach

                </tbody>
            </table>

\
@endsection