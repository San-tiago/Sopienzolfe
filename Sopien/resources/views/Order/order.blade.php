@extends('layouts.menu')

@section('content')
@if(Auth::user()->Account_Status == 'Deactivated')
        <div class="d-flex justify-content-center">
            <div class="alert alert-danger " role="alert">
                Your account have been deactivated because of too much cancelled orders
            </div>
        </div>
@else
        <!-- Start Gallery -->
        <div class="gallery-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-title text-center">
                                <h2>Your Food Cart</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                            </div>
                        </div>
                    </div>
                    <div class="tz-gallery">
                        <div class="row mb-5">
                        @foreach($orders as $order)
                            <div class="col-sm-12 col-md-4 col-lg-4 mb-5"> 
                                <a class="lightbox">
                                    <img class="img-fluid" src="{{asset('images/'.$order->menu_image)}}" alt="Gallery Images">
                                </a>
                                <strong><p>{{$order->menu_name}}</p></strong>
                                <p class="card-text">Qty: {{$order->quantity}}</p>
                                <p class="card-text"> <strong>Sub Total: P {{$order->menu_price}}</strong></p>
                                <div class="btn btn-danger" data-toggle="modal" data-target="#removeModal">Remove</div>

                            </div>
                            
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Shipping Fee</p>
                        <p class="text-secondary mr-5">P 150</p>
                    </div>

                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Order Time</p>
                        <p class="text-secondary mr-5">{{date('m/d/Y h:i:s a', strtotime($order->created_at))}}</p>
                    </div>

                    <div class="d-flex justify-content-between border-bottom mb-3">
                        <p class="text-secondary ml-5">Ship Date</p>
                        <p class="text-secondary mr-5">{{date('m/d/Y', strtotime($order->created_at. '+3 days'))}}</p>
                    </div>

                        @if($total > 0)
                            <div class="d-flex p-2 d-flex justify-content-center border my-5">
                                <h1 name="total" class="font-weight-bold">Total:{{$total + 150}}</h1>
                            </div>
                            

                        <button type="button" class="btn btn-primary w-100 d-flex p-2 d-flex justify-content-center mt-5" data-toggle="modal" data-target="#exampleModal">
                            Checkout
                        </button>
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
            <!-- End Gallery -->
@endif


                                      
                                        
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
          
                <script>
                    function remove(){
                        alert("Order Removed Successfully!")
                    }
                </script>

           
@endsection