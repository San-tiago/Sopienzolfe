@extends('layouts.app')

@section('content')
<div class="container">
        <div>
        @foreach($categories as $category)
                   <a href="/menu/{{$category->category}}"><button>{{$category->category}}</button></a>
        @endforeach
        </div>

        @foreach($users as $user)
        @endforeach
    @foreach($menus as $menu)
    <div>
        
            <form action="{{url('/order')}}" method = "post">
            @csrf
            @if($user->email === Auth::user()->email)
                <input type="text" value="{{$user->id}}" name = "user_id"><br>
            @endif
            <input type="hidden" value ="{{ Auth::user()->email }}" name="email"><br>
            <input type="text" value = "{{$menu->food_name}}" name = "menu_name" readonly><br>
            <input type="text" value = "{{$menu->menu_category}}" name = "menu_category" readonly><br>
            <input type="text" value = "{{$menu->description}}" name = "menu_description" readonly><br>
            <input type="text" value = "{{$menu->price}}" name = "menu_price" readonly><br>
                <input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" min="1" name = "quantity" value = "1">
           <input type="submit" value = "Add to Orderlist">
            </form>
        
    </div>
        @endforeach
</div>
@endsection
