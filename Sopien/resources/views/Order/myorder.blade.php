@extends('layouts.menu')

@section('content')
    <!-- Order Status -->

	
@if(auth::user()->Order_Status !== 'Ordering' && auth::user()->Order_Status !== 'None')
    <div class="gallery-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Order Status</h2>
						
					</div>
				</div>
			</div>
			<div class="container">
        <div class="d-flex p-2 d-flex justify-content-center table-bordered d-flex justify-content-around shadow-sm p-3 mb-3 bg-white rounded flex-nowrap">
         <div >
         @if(Auth::user()->Order_Status == 'Pending' || Auth::user()->Order_Status == 'Approve' || Auth::user()->Order_Status == 'Processed' || Auth::user()->Order_Status == 'On Delivery' )
            <button type="button" class="btn btn-success">Pending</button>
        @else
            <button type="button" class="btn btn-secondary">Pending</button>
        @endif
        </div>
        <div>
        @if(Auth::user()->Order_Status == 'Approve' || Auth::user()->Order_Status == 'Processed' || Auth::user()->Order_Status == 'On Delivery' )
            <button type="button" class="btn btn-success">Approved</button>
        @else
        <button type="button" class="btn btn-secondary">Approved</button>
        @endif
         </div>
        <div>
        @if(Auth::user()->Order_Status == 'Processed' || Auth::user()->Order_Status == 'On Delivery' )
            <button type="button" class="btn btn-success">Processed</button>
        @else
            <button type="button" class="btn btn-secondary">Processed</button>
        @endif
        </div>
        <div>
        @if(Auth::user()->Order_Status == 'On Delivery' )
            <button type="button" class="btn btn-success">On Delivery</button>
        @else
            <button type="button" class="btn btn-secondary">On Delivery</button>
        @endif
             
        </div>
    </div>
@endif
		</div>
	</div>
    <!-- Order Status -->


<!-- Start Gallery -->
	<div class="gallery-box">
		<div class="container">
			<div class="tz-gallery">
				<div class="row">
    @if(!$orders->isEmpty())
                    @foreach($orders as $order)
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <a class="lightbox">
                                <img class="img-fluid" src="{{asset('images/'.$order->menu_image)}}" alt="Gallery Images">
                            </a>
                            <strong><p>{{$order->menu_name}}</p></strong>
                            <p class="card-text">Qty: {{$order->quantity}}</p>
                            <p class="card-text"> <strong>Sub Total: P {{$order->menu_price}}</strong></p>
                        </div>
                        
                    @endforeach
               
				</div>
			</div>
		</div>
	    </div>  
        
                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Payment Type</p>
                        <p class="text-secondary mr-5">{{$paymenttype['payment_type']}}</p>
                    </div>
                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Shipping Fee</p>
                        <p class="text-secondary mr-5">P{{150}}</p>
                    </div>

                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Order Time</p>
                        <p class="text-secondary mr-5">{{date('m/d/Y h:i:s a', strtotime($order->created_at))}}</p>
                    </div>

                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Ship Date</p>
                        <p class="text-secondary mr-5">{{date('m/d/Y', strtotime($order->created_at. '+3 days'))}}</p>
                    </div>
       
        <div class="d-flex p-2 d-flex justify-content-center border my-5">
                                <h1 name="total" class="font-weight-bold">Total: P {{$orders_sum + 150}}</h1>
        </div>
      
	<!-- End Gallery -->
    

    @else
    <div class="card text-center m-auto mb-5 h-100vh">
        <div class="card-body ">
            <h5 class="card-title"></h5>
            <img class="img-thumbnail" src="{{asset('images/sopien.jpg')}}" height="250px"/>
            <p class="h2 mt-5 mb-5">You have no order</p>
            <a href="/home" class="btn btn-primary">Click here to order</a>
        </div>
    </div>
    @endif



    
 

     

                    
                
    
            
    
    <div class="d-flex p-2 d-flex justify-content-center" >
                    @if(Auth::user()->Order_Status == 'Pending')   
                        <!-- Button payment modal -->
                            <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleModal">
                            Pay Here
                            </button> 
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
                        Cancel Orders
                        </button>

                    @endif
            </div>

        @if(!$orders->isEmpty())
                            <!-- Cancel Order Modal -->
                    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Do you want to cancel your order?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                
                                <a href="{{url('/cancel-order/'.Auth::user()->email.'/'.$order->id)}}"><button type="button" class="btn btn-primary">Confirm</button> </a>
                            </div>
                            </div>
                        </div>
                    </div>
        @endif

              

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content w-100">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center w-100">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('images/sopienzolfe_gcash.jpg')}}" alt="Card image cap">
                                <p class="card-text align-self-center pt-2">or on this number below</p>
<!--                                 <h2 id="gcash_number" class="card-text align-self-center" value="+6399999999">+6399999999</h2>
 -->                                <input type="text" value="+6399999999" id="myInput" class="text-center rounded border border-info font-weight-bold" readonly>
                                <button type="button" class="btn btn-info" onclick="myFunction()">Copy</button>
                                <p class="card-text align-self-center p-md-3">After sending the payment, just wait for the approval of your order. Thank you!</p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>



<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
  
}
</script>
</div>
@endsection
