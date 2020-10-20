@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Edit Menu</h1>


    <form action="{{url('/menu/update/'.$menu->id)}}" method="post">
        @csrf
        Food Name: <input type="text" name="food_name" value="{{$menu->food_name}}"><br>
        <span style="color: red">@error('food_name'){{$message}}@enderror</span><br>


       Category: <select name="menu_category">
                @foreach($categories as $category)
                   <option>{{$category->category}}</option>
                @endforeach
                </select><br>

        Description: <input type="textbox" name = "description" value= "{{$menu->description}}"><br>
        <span style="color: red">@error('description'){{$message}}@enderror</span><br>
        Price: <input type="text" name="price" value= "{{$menu->price}}"><br>
        <span style="color: red">@error('price'){{$message}}@enderror</span><br>
        <input type="submit" value="Submit"><br>
    </form>
</body>
</html>
</div>
@endsection