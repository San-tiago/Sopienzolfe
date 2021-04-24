<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Sopienzolfe</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS {{asset('')}}-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">    
	<!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  
    </head>
    <body>
        <!--  -->
        <!-- Start header -->
	<header class="top-navbar">
    @if (Route::has('login'))
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="index.html">
					Sopienzolfe
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-rs-food">
					<ul class="navbar-nav ml-auto">
                        @auth
						<li class="nav-item active"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                        @else
						@if($uri == null)
						<li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
						@else
						<li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
						@endif
						<li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
						@if($uri == 'login')
						<li class="nav-item active"><a class="nav-link" href="{{ route('login') }}">Log-In</a></li>
						@else
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log-In</a></li>
						@endif
                            @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
					</ul>
				</div>
			</div>
		</nav>
        @endif
	</header>
	<!-- End header -->
		


    <!-- Start slides -->
	<div id="slides" class="cover-slides">
		<ul class="slides-container">
			<li class="text-left">
				<img src="{{asset('images/slider-01.jpg')}}" alt="">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="m-b-20"><strong>Welcome To <br> Sopienzolfe</strong></h1>
							<p class="m-b-40">Need food for your occasion? No time for cooking? </p>
							<p class="m-b-40">We got your back.</p>
							
						</div>
					</div>
				</div>
			</li>
			<li class="text-left">
				<img src="{{asset('images/slider-02.jpg')}}" alt="">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="m-b-20"><strong>Welcome To <br> Sopienzolfe</strong></h1>
							<p class="m-b-40">Need food for your occasion? No time for cooking? </p>
							<p class="m-b-40">We got your back.</p>
							
						</div>
					</div>
				</div>
			</li>
			<li class="text-left">
				<img src="{{asset('images/slider-03.jpg')}}" alt="">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="m-b-20"><strong>Welcome To <br> Sopienzolfe</strong></h1>
							<p class="m-b-40">Need food for your occasion? No time for cooking? </p>
							<p class="m-b-40">We got your back.</p>
							
						</div>
					</div>
				</div>
			</li>
		</ul>
		<div class="slides-navigation">
			<a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
		</div>
	</div>
	<!-- End slides -->    


    	<!-- Start About -->
	<div class="about-section-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 text-center">
					<div class="inner-column">
						<h1>Welcome To <span>Sopienzolfe</span></h1>
						<h4>Little Story</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor suscipit feugiat. Ut at pellentesque ante, sed convallis arcu. Nullam facilisis, eros in eleifend luctus, odio ante sodales augue, eget lacinia lectus erat et sem. </p>
						<p>Sed semper orci sit amet porta placerat. Etiam quis finibus eros. Sed aliquam metus lorem, a pellentesque tellus pretium a. Nulla placerat elit in justo vestibulum, et maximus sem pulvinar.</p>
					
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<img src="{{asset('images/about-img.jpg')}}" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
	<!-- End About -->



    <!-- Start QT -->
	<div class="qt-box qt-background">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto text-center">
					<p class="lead ">
					</p>
					<span class="lead"></span>
				</div>
			</div>
		</div>
	</div>
	<!-- End QT -->


<!-- Start All Pages -->
<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
				<h1 class="display-1">Menu</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
    <!-- Start Menu -->
	<div class="menu-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2></h2>
					</div>
				</div>
			</div>
			
			<div class="row inner-menu-box">
				<div class="col-3">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All</a>
						@foreach($categories as $category)
							<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{$category->category}}</a>
						@endforeach
					</div>
				</div>  
				
				<div class="col-9">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div class="row">
                            @foreach($menus as $menu)
								<div class="col-lg-4 col-md-6 special-grid drinks">
									<div class="gallery-single fix">
										<img src="{{asset('images/'.$menu->image)}}" class="img-fluid" alt="Image">
										<div class="why-text">
											<h4>{{$menu->food_name}}</h4>
											<p>{{$menu->description}}.</p>
											<h5> P {{$menu->price}}</h5>
                                            
										</div>
									</div>
								</div>
							@endforeach
                          </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Menu -->

	<!-- Start Gallery -->
	<div class="gallery-box"> 
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Gallery</h2>
					</div>
				</div>
			</div>
			<div class="tz-gallery">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4"> 
						<a class="lightbox" href="images/gallery-img-01.jpg">
							<img class="img-fluid" src="images/gallery-img-01.jpg" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-02.jpg">
							<img class="img-fluid" src="images/gallery-img-02.jpg" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-03.jpg">
							<img class="img-fluid" src="images/gallery-img-03.jpg" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-04.jpg">
							<img class="img-fluid" src="images/gallery-img-04.jpg" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-05.jpg">
							<img class="img-fluid" src="images/gallery-img-05.jpg" alt="Gallery Images">
						</a>
					</div> 
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-06.jpg">
							<img class="img-fluid" src="images/gallery-img-06.jpg" alt="Gallery Images">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Gallery -->

    


<!-- Start Contact info -->
<div class="contact-imfo-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4 arrow-right">
					<i class="fa fa-volume-control-phone"></i>
					<div class="overflow-hidden">
						<h4>Phone</h4>
						<p class="lead">
						0966 591 3386

						</p>
					</div>
				</div>
				<div class="col-md-4 arrow-right">
					<i class="fa fa-envelope"></i>
					<div class="overflow-hidden">
						<h4>Email</h4>
						<p class="lead">
							sopienzfole@gmail.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker"></i>
					<div class="overflow-hidden">
						<h4>Location</h4>
						<p class="lead">
						Sabutan, Silang, Cavite
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact info -->
	
	<!-- Start Footer -->
	<footer class="footer-area bg-f">
		<div class="container">	
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3>About Us</h3>
					<a href="{{ url('/terms&conditions') }}"><p>Terms and Conditions</p></a>
                    <a href=""><p>Privacy Policy</p></a>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Follow us on</h3>
					
					<ul class="list-inline f-social">
						<li class="list-inline-item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Contact information</h3>
					<p><span class="text-color">0966 591 3386</span></p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Opening hours</h3>
					<p><span class="text-color">Monday: </span>Closed</p>
					<p><span class="text-color">Tue-Wed :</span> 9:Am - 10PM</p>
					<p><span class="text-color">Thu-Fri :</span> 9:Am - 10PM</p>
					<p><span class="text-color">Sat-Sun :</span> 5:PM - 10PM</p>
				</div>
			</div>
		</div>
		
	</footer>
	<!-- End Footer -->

<!-- ALL JS FILES -->
<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
	<script src="js/jquery.superslides.min.js"></script>
	<script src="js/images-loded.min.js"></script>
	<script src="js/isotope.min.js"></script>
	<script src="js/baguetteBox.min.js"></script>
	<script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
    </body>
</html>
