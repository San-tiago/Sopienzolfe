
@extends('layouts.menu')

@section('content')
<!-- Start Menu -->
<div class="menu-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Special Menu</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					</div>
				</div>
			</div> 
			
			<div class="row inner-menu-box">
				<div class="col-3">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @if($menus_count > 0) 
                         @if(Auth::user()->Order_Status == 'None' && $menus_count > 0)
						    <a class="nav-link" href="{{url('/receiver_page')}}"  role="tab">Create Order</a>
                        @endif
                        <a class="nav-link " href="{{url('/home')}}" role="tab">All</a>
                        @foreach($categories as $category)
						    <a class="nav-link"   href="/menu/{{$category->category}}">{{$category->category}}</a>
                        @endforeach
                    @endif

                      
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
											<h5> ${{$menu->price}}</h5>
										</div>
									</div>
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
			</div>
		</div>
	</div>
	<!-- End Menu -->
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



