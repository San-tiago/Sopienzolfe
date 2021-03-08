@extends('layouts.menu')

@section('content')
<div>

<div class="container">
@if(auth::user()->Order_Status !== 'Ordering' && auth::user()->Order_Status !== 'None')
    <div class="d-flex  d-flex justify-content-center table-bordered shadow-sm bg-white rounded"> <h1>Order Status</h1></div>
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
    
   <div class="flex-column"> 

        <h1 class="d-flex p-2 d-flex justify-content-center p-3 border bg-white rounded mb-0">Order Details</h1>    
        @if(!$orders->isEmpty())
                @foreach($orders as $order)
                    
                    <div class="d-flex flex-row justify-content-center w-100 h-75 align-self-center  border d-flex flex-wrap bg-white rounded text-secondary">
                        <img  class="w-25 p-3 h-75 ml-0" src="{{asset('images/'.$order->menu_image)}}">
                        <div class="flex-column justify-content-start w-75 mt-1">
                            <h4 class="font-weight-bold ">{{$order->menu_name}}</h4>
                            <p class="text-secondary mb-1">Description: {{$order->menu_description}}</p>
                            <p class="text-secondary mb-1">Quantity :{{$order->quantity}}</p>
                            <p class="font-weight-bold mb-1">P {{$order->menu_price}}</p>
                        </div>
                    </div>
                    
                @endforeach
                <div class="d-flex p-2 d-flex justify-content-center p-3 border mb-3 bg-white rounded mt-0">
                    <h3 name="total">Total: P{{$orders_sum}}</h3>
                </div>
    </div> 

    @if(Auth::user()->Order_Status == 'Approve' || Auth::user()->Order_Status == 'Processed' || Auth::user()->Order_Status == 'On Delivery')    

                <div class="d-flex justify-content-center w-100 h-75 align-self-center p-3 border d-flex flex-wrap flex-column shadow-sm p-3 mb-5 bg-white rounded text-secondary">
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary">Order Time</p>
                        <p class="text-secondary">{{date('m/d/Y h:i:s a', strtotime($order->created_at))}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary">Ship Date</p>
                        <p class="text-secondary">{{date('m/d/Y', strtotime($order->created_at. '+3 days'))}}</p>
                       
                    </div>
                </div>
                <form action="{{url('/customer-message')}}" method="post">
                    @csrf
                <div class="input-group mb-3">
                    <input type="text" name = "customermessage"class="form-control" placeholder="Send message to admin" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value = "Send">
                    </div>
                    
                </div>
                </form>
                @if(session('message_sent'))
                        <div class="d-flex justify-content-center alert alert-success" role="alert">
                            <h5>{{Session::get('message_sent')}}</h5>
                        </div>
                @endif
    @endif
            @if(Auth::user()->Order_Status == 'Pending')   
                  <!-- Button payment modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Pay Here
                    </button> 
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
                Cancel Orders
                </button>

            @endif
            

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
@else
<div class="card text-center mt-md-3">

        <div class="card-body ">
            <h5 class="card-title"></h5>
            <p class="h2">You have no Order</p>
            <a href="/home" class="btn btn-primary">Click here to Order</a>
        </div>
</div>
@endif


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
