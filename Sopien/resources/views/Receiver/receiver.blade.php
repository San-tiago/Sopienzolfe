@extends('layouts.menu')

@section('content')
<!-- Start Reservation -->
<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Receiver Form</h2>
						<p>Please fillup the following information</p>
					</div>
				</div>
			</div>
      
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="contact-block">
						<form action="{{url('/receiver')}}" method="post">
                @csrf
							  <div class="row">
								  <div class="col-md-6">
								  	<div class="col-md-12">
                    <label class="text-secondary">FROM</label>
										<div class="form-group">
											<input id="input_date" class="datepicker picker__input form-control" name = "fromemail" type="email" value="{{ Auth::user()->email }}" readonly>
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
                  <label class="text-secondary">RECEIVER NAME</label>
										<div class="form-group">
											<input name = "receivername" type="text" id="input_time" value="{{old('receivername')}}" class="time form-control picker__input" required data-error="Please enter time" placeholder="Receiver Name">
											<div class="help-block with-errors"> <span style="color: red">@error('receivername'){{$message}}@enderror </span></div>
										</div>                                 
									</div>
					<div class="col-md-12">
                   	 	<label class="text-secondary">PAYMENT TYPE</label>
						<div class="form-group">
							<select class="custom-select d-block form-control" name="payment_type" >
								<option value="Partial">Partial</option>
								<option value="Full">Full</option>
							</select>
							<div class="help-block with-errors"></div>
						</div> 
                    </div>

									<div class="col-md-12">
                  <label class="text-secondary">PROVINCE/REGION</label>
										<div class="form-group">
										    <select class="custom-select d-block form-control" id="province" name="province">
                         						 <option>NCR</option>
                        					</select>
											</select>
											<div class="help-block with-errors"></div>
										</div> 
									</div>
								</div>
								<div class="col-md-6">
                  <div class="col-md-12">
                   	 	<label class="text-secondary">CITY/MUNICIPALITY</label>
						<div class="form-group">
							<select class="custom-select d-block form-control" id="message" name="municipality/city">
							
							</select>
							<div class="help-block with-errors"></div>
						</div> 
                    </div>
									<div class="col-md-12">
                  <label class="text-secondary">DELIVERY ADDRESS</label>
										<div class="form-group">
											<input type="text" value="{{old('receiveraddress')}}" placeholder="Address" class="form-control" id="name" name="receiveraddress" placeholder="Address" required data-error="Please enter your address">
											<div class="help-block with-errors"><span style="color: red">@error('receiveraddress'){{$message}}@enderror</span></div>
										</div>                                 
									</div>
									<div class="col-md-12">
                  <label class="text-secondary">CONTACT NUMBER</label>
										<div class="form-group">
											<input type="text" placeholder="Contact Number" value="{{old('receivercontactnumber')}}" id="email" class="form-control" name="receivercontactnumber"  required data-error="Please enter your number">
											<div class="help-block with-errors"><span style="color: red">@error('receivercontactnumber'){{$message}}@enderror</span></div>
										</div> 
									</div>
									
								</div>
								<div class="col-md-12">
									<div class="submit-button text-center">
										<button type="submit" class="btn btn-primary">Submit</button>
										<div id="msgSubmit" class="h3 text-center hidden"></div> 
										<div class="clearfix"></div> 
									</div>
								</div>
							</div>            
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Reservation -->


@endsection
