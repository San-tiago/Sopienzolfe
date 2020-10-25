@extends('layouts.app')

@section('content')
<div class="container">
    
    @foreach($menus as $menu)
    <div>
    
            <form action="{{url('/order')}}" method = "post">
            @csrf
            <input type="hidden" value ="{{ Auth::user()->name }}" name="user_name"><br>
            <input type="text" value = "{{$menu->food_name}}" name = "menu_name" readonly><br>
            <input type="text" value = "{{$menu->menu_category}}" name = "menu_category" readonly><br>
            <input type="text" value = "{{$menu->description}}" name = "menu_description" readonly><br>
            <input type="text" value = "{{$menu->price}}" name = "menu_price" readonly><br>

           <input type="submit" value = "Order">
            </form>
    </div>
        @endforeach
</div>
@endsection
