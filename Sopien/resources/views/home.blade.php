@extends('layouts.app')

@section('content')
<div class="container">
    
    @foreach($menus as $menu)
    <div>
    
            
            <td>{{$menu->food_name}}</td><br>
            <td>{{$menu->menu_category}}</td><br>
            <td>{{$menu->description}}</td><br>
            <td>{{$menu->price}}</td> <br>
            <a href=""><button>Order</button></a>
    </div>
        @endforeach
</div>
@endsection
