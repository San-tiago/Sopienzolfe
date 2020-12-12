
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
        
        <div class="nav">
            <h1>Categories</h1>
            <div class = "category">
                <a href="/home"><button type="button" class="btn btn-outline-dark btn-lg">All</button></a></li>
            @foreach($categories as $category)
                    <a href="/menu/{{$category->category}}"><button type="button" class="btn btn-outline-dark btn-lg">{{$category->category}}</button></a></li>
            @endforeach
                
            </div>
        
        
        </div> 
            
        <div class = "menu">
           
             
                    @if(Auth::user()->Order_Status == 'None')
                    <a href="/receiver_page"><button type="button" class="btn btn-success">Create Order</button></a> 
                    @endif
            
            @foreach($menus as $menu)
            
            <div class = "menu-form">
                <form action="{{url('/order')}}" method = "post">
                @csrf
                <input type="hidden" value="{{$menu->id}}" name = "menu_id"><br>
                @foreach($users as $user)
                    @if($user->email === Auth::user()->email)
                    <input type="hidden" value="{{$user->id}}" name = "user_id"><br>
                    @endif
                @endforeach 
                <input type="hidden" value ="{{ Auth::user()->email }}" name="email"><br>
                <label> Food Name: </label><input type="text" value = "{{$menu->food_name}}" name = "menu_name" readonly><br>
                <label> Category: </label><input type="text" value = "{{$menu->menu_category}}" name = "menu_category" readonly><br>
                <label> Description: </label><input type="text" value = "{{$menu->description}}" name = "menu_description" readonly><br>
            @if(Auth::user()->Order_Status == 'Ordering')
                
                        <label> Price: </label><input type="text" value = "{{$menu->price}}" name = "menu_price" readonly><br>
                        <label> Quantity: </label><input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" min="1" name = "quantity" value = "1">
                        
                            <input type="hidden" value="{{$new_transac}}" name = "order_id">
                       
                        <input type="submit" value = "Add to Food Cart"><br>
                        
                 
            @endif
                </form>
            </div>
        
            @endforeach
    
        </div>
    </div>
@endif
@endsection

