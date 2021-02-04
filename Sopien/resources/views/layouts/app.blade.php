<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/114bfafc96.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/114bfafc96.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
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

</head>
<body>
    <div id="app">
        
    <header>
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
						<li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>        
						<li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
						<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log-In</a></li>
                            @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
					</ul>
				</div>
			</div>
		</nav>
    </header>
        <main class="py-4 ">
            @yield('content')
        </main>
    </div>
    

	
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


<script>

    $(function(){
        var $name = $('#message')
        $.ajax({
            url: "https://psgc.gitlab.io/api/regions/040000000/cities/",
            type: "GET",
            dataType: "JSON",
            data:JSON.stringify({ }),
            success:function(data){
                $.each(data,function(i, city){
                    $name.append("<option>"+ city.name+"</option>");
                })
                //console.log('success',data)
                   // $('.messages').append("<li>"+JSON.stringify(data)+"</li>");
            }
        });
    })

    $(function(){
        var $province = $('#province')
        $.ajax({
            url: "https://psgc.gitlab.io/api/regions/040000000/provinces/",
            type: "GET",
            dataType: "JSON",
            data:JSON.stringify({ }),
            success:function(data){
                console.log('success',data)
                $.each(data,function(i, city){
                    $province.append("<option>"+ city.name+"</option>");
                })
            }
        });
    })
    $(function(){
        var $ncr_cities = $('#message')
        $.ajax({
            url: "https://psgc.gitlab.io/api/regions/130000000/cities/",
            type: "GET",
            dataType: "JSON",
            data:JSON.stringify({ }),
            success:function(data){
                console.log('success',data)
                $.each(data,function(i, city){
                    $ncr_cities.append("<option>"+ city.name+"</option>");
                })
            }
        });
    })

</script>
</html>
