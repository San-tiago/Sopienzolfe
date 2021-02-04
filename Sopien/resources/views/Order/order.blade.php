@extends('layouts.menu')

@section('content')
<div class="menu-box">
		<div class="container">

        @if(Auth::user()->Account_Status == 'Deactivated')
        <div class="d-flex justify-content-center">
            <div class="alert alert-danger " role="alert">
                Your account have been deactivated because of too much cancelled orders
            </div>
        </div>
        @else
        <div >
            <a href="/home"><button button type="button" class="btn btn-primary">Back</button></a>

            <div class="d-flex p-2 d-flex justify-content-center mb-4 bg-white shadow-sm"><h1>Order List</h1></div>


                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="row">
                                    @foreach($orders as $order)
                                        <div class="col-lg-4 col-md-6 special-grid drinks">
                                            <div class="gallery-single fix">
                                                <img src="{{asset('images/'.$order->menu_image)}}" class="img-fluid" alt="Image">
                                                <div class="why-text">
                                                <p>{{$order->menu_description}}.</p>
                                                </div>
                                                <h4>{{$order->menu_name}}</h4>
                                                <p>Qty: {{$order->quantity}}</p>
                                                <h5>Sub Total: ${{$order->menu_price}}</h5>
                                            </div>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeModal">Remove</button>
                                            

                                        </div>
                                         <!-- Modal -->
                                <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to remove {{$order->menu_name}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="{{url('order/delete/'.$order->id)}}"><button type="button" class="btn btn-primary">Yes</button></a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    
                                    @endforeach
                                </div>
                                </div>
                            </div>
                           
       

            
            @if($total > 0)
                <div class="d-flex p-2 d-flex justify-content-center bg-white shadow my-5"><h1 name="total" class="font-weight-bold">Total:{{$total}}</h1>
                </div>
                
            
                <button type="button" class="btn btn-primary w-100 d-flex p-2 d-flex justify-content-center" data-toggle="modal" data-target="#exampleModal">
                    Checkout
                </button>
                   

                    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Are you sure do you want to checkout now?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{url('/placeorder')}}"><button type="button" class="btn btn-primary">Confirm</button> </a>
      </div>
    </div>
  </div>
</div>
            @else
                <div class="d-flex p-2 d-flex justify-content-center">
                    <a href="/receiver_page">
                        <button type="button" class="btn btn-primary">Click here to Create Order
                        </button>
                    </a>
                </div>
            @endif
            
        </div>
    </div>
</div>

<script>
    function remove(){
        alert("Order Removed Successfully!")
    }
</script>

@endif
@endsection