@extends('layouts.menu')

@section('content')
    <!-- Start Reservation -->
<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Account Details</h2>
					
					</div>
				</div>
			</div>
      
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="contact-block">
							  <div class="row">
								  <div class="col-md-6">
								  	<div class="col-md-12">
                                        <label class="text-secondary">First Name</label>
										<div class="form-group">
											<input class="datepicker picker__input form-control" type="text" value ="{{auth::user()->name}}"readonly>
											
										</div>                                 
									</div>
									<div class="col-md-12">
                                         <label class="text-secondary">Last Name</label>
										<div class="form-group">
											<input type="text" class="time form-control picker__input" value ="{{auth::user()->lastname}}" readonly>
										</div>                                 
									</div>
									<div class="col-md-12">
                                            <label class="text-secondary">Address</label>
										<div class="form-group">
                                        <input type="text" class="time form-control picker__input" value ="{{auth::user()->address}}" readonly>
										</div> 
									</div>
								</div>
								<div class="col-md-6">
                  <div class="col-md-12">
                    <label class="text-secondary">Email</label>
                      <div class="form-group">
                      <input type="text" class="time form-control picker__input" value ="{{auth::user()->email}}" readonly>

                      </div> 
                    </div>
									<div class="col-md-12">
                  <label class="text-secondary">Contact Number</label>
										<div class="form-group">
                                        <input type="text" class="time form-control picker__input" value ="{{auth::user()->contactnumber}}" readonly>

										</div>                                 
									</div>
									
									
								</div>
								<div class="col-md-12">
									<div class="submit-button text-center">
										<!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                             Edit
                                        </button>
										<div class="clearfix"></div> 
									</div>
								</div>
							</div>            
					</div>

                        

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="card-body">
                    <form method="POST" action="{{url('/edit-accountdetails')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{auth::user()->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="lastname" value="{{auth::user()->lastname}}" required autocomplete="name" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{auth::user()->address}}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactnumber" class="col-md-4 col-form-label text-md-right">{{ __('ContactNumber') }}</label>

                            <div class="col-md-6">
                                <input id="contactnumber" type="text" class="form-control @error('contactnumber') is-invalid @enderror" value="{{auth::user()->contactnumber}}" name="contactnumber" required autocomplete="contactnumber">

                                @error('contactnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                            </div>
                            
                            </div>
                        </div>
                        </div>
				</div>
			</div>
		</div>
	</div>
@endsection