@extends('layouts.menu')

@section('content')
<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Customer Review</h1>
				</div>
			</div>
		</div>
	</div>
    <!-- Start Contact -->
	
	<div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Customer Review </h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form action="{{url('/insert-reviewform')}}" method="post">
                        @csrf
						<div class="row">	
							<div class="col-md-12">
								<div class="form-group"> 
									<textarea class="form-control" id="message" name ="review_message" placeholder="Your Message" rows="4" data-error="Write your message" required></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<div class="submit-button text-center">
									<input class="btn btn-common" id="submit" type="submit" value="Submit">
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
	<!-- End Contact -->
@endsection