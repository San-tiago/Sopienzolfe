
@extends('layouts.menu')

@section('content')
@if(Auth::user()->Account_Status == 'Deactivated')
<div class="d-flex justify-content-center">
    <div class="alert alert-danger " role="alert">
         Your account have been deactivated because of too much cancelled orders
    </div>
</div>
@else
    <div class = "flex-container">
    @if($menus_count > 0)   
        <div class="nav">
            <h1>Categories</h1>
            <div class = "category">
                <a href="/home"><button type="button" class="btn btn-outline-dark btn-lg">All</button></a></li>
            @foreach($categories as $category)
                    <a href="/menu/{{$category->category}}"><button type="button" class="btn btn-outline-dark btn-lg">{{$category->category}}</button></a></li>
            @endforeach
                
            </div>
        
        
        </div> 
    @endif
            
        <div class = "menu">
           
                    @if(Auth::user()->Order_Status == 'None' && $menus_count > 0)
                        <a href="/receiver_page"><button type="button" class="btn btn-success">Create Order</button></a> 
                    @endif
            
            @foreach($menus as $menu)
            <div class="card mr-3" style="width: 18rem;">
                <img src="https://www.inspiredtaste.net/wp-content/uploads/2019/03/Spaghetti-with-Meat-Sauce-Recipe-1-1200.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <div class="card-body">
                   
   
                
                <form action="{{url('/order')}}" method = "post">
                    @csrf
                
                @foreach($users as $user)
                    @if($user->email === Auth::user()->email)
                    <input type="hidden" value="{{$user->id}}" name = "user_id"><br>
                    @endif
                @endforeach 
                    <h2 class="card-title">{{$menu->food_name}}</h2>
                    <input type="hidden" value ="{{ Auth::user()->email }}" name="email">
                    <input type="hidden" value = "{{$menu->food_name}}" name = "menu_name">

                    <h3 class="card-title">Price: {{$menu->price}}</h3>
                    <input type="hidden" value = "{{$menu->menu_category}}" name = "menu_category">
                    <input type="hidden" value = "{{$menu->description}}" name = "menu_description">

                    <p class="card-text"> Description :{{$menu->description}}.</p>
                    <input type="hidden" value = "{{$menu->price}}" name = "menu_price">
                    <input type="hidden" value="{{$new_transac}}" name = "order_id">
                    <input type="hidden" value="{{$menu->id}}" name = "menu_id">
                    
                    @if(Auth::user()->Order_Status == 'Ordering')
                
                        
                        <label> Quantity: </label><input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" min="1" name = "quantity" value = "1"><br>
                        <input type="submit" value = "Add to Food Cart" class="btn btn-primary">
                        
                    @endif

                </form>
                </div>
                </div>
            </div>
            
            
        
            @endforeach
    
        </div>
    </div>
@endif
@endsection

