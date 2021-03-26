
@extends('layouts.menu')

@section('content')
   <!-- Start Gallery -->
   <div class="gallery-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-title text-center">
                                <h2>Sopienzolfe Menu</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                            </div>
							<div class="d-flex flex-row justify-content-center mb-1">
								@if($menus_count > 0) 
									@if(Auth::user()->Order_Status == 'None' && $menus_count > 0)
										<div class="p-2">
											<h3>
											<a class="nav-link" href="{{url('/receiver_page')}}"  role="tab">Create Order</a>
											</h3>
										</div>
									@endif
									<div class="p-2">
										<h3>
										<a class="nav-link " href="{{url('/home')}}" role="tab">All</a>
										</h3>
									</div>
									@foreach($categories as $category)
										<div class="p-2">
											<h3>
												<a class="nav-link"   href="/menu/{{$category->category}}">{{$category->category}}</a>
											</h3>
										</div>
									@endforeach
								@endif
							</div>
                        </div>
                    </div>
                    <div class="tz-gallery">
                        <div class="row mb-5">
                        @foreach($menus as $menu)
                            <div class="col-sm-12 col-md-4 col-lg-4 mb-5"> 
                                <a class="lightbox">
                                    <img class="img-fluid" src="{{asset('images/'.$menu->image)}}" alt="Gallery Images">
                                </a>
                                <strong><p>{{$menu->food_name}}</p></strong>
                                <p class="card-text">Description: {{$menu->description}}</p>
                                <p class="card-text"> <strong>Price: P{{$menu->price}}</strong></p>
								<form action="{{url('/order')}}" method = "post">
                                        @csrf
                        
                                    @foreach($users as $user)
                                        @if($user->email === Auth::user()->email)
                                        <input type="hidden" value="{{$user->id}}" name = "user_id"><br>
                                        @endif
                                    @endforeach 
                                        <input type="hidden" value ="{{ Auth::user()->email }}" name="email">
                                        <input type="hidden" value = "{{$menu->food_name}}" name = "menu_name">
                                
                        
                                        <input type="hidden" value = "{{$menu->menu_category}}" name = "menu_category">
                                        <input type="hidden" value = "{{$menu->description}}" name = "menu_description">

                                        
                                        <input type="hidden" value = "{{$menu->price}}" name = "menu_price">
                                        <input type="hidden" value = "{{$menu->image}}" name = "menu_image">
                                        <input type="hidden" value="{{$new_transac}}" name = "order_id">
                                        <input type="hidden" value="{{$menu->id}}" name = "menu_id">
                                        
                                        @if(Auth::user()->Order_Status == 'Ordering')
                                            <label> Quantity: </label><input type="number" class="form-control w-27" aria-label="Username" aria-describedby="basic-addon1" min="1" name = "quantity" value = "1"><br>
                                            <input type="submit" value = "Add to Food Cart" class="btn btn-primary" id="AddtoCart" onclick="addtoCart()">
                                        @endif

                                    </form>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Gallery -->

@if(Auth::user()->Account_Status == 'Deactivated')
<div class="d-flex justify-content-center">
    <div class="alert alert-danger " role="alert">
         Your account have been deactivated because of too much cancelled orders
    </div>
</div> 
<script>
	function addtoCart(){
        alert("Add to cart successfully!")
    }
</script>

@endif

@endsection



