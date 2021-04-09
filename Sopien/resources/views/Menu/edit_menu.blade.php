@extends('layouts.admin_layout')

@section('dashboard')
<div>
<h1>Edit Menu</h1>


    <form action="{{url('/menu/update/'.$menu->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="exampleInputEmail1">Food Name</label>
        <input type="text" class="form-control" name="food_name" value="{{$menu->food_name}}"><br>
        <span style="color: red">@error('food_name'){{$message}}@enderror</span><br>

        <label for="exampleInputEmail1">Category</label>
        <select name="menu_category" class="form-control">
                @foreach($categories as $category)
                   <option>{{$category->category}}</option>
                @endforeach
                </select><br>  
        <label for="exampleInputEmail1">Food Description</label>
        <input type="textbox" name = "description" class="form-control" value= "{{$menu->description}}"><br>
        <span style="color: red">@error('description'){{$message}}@enderror</span><br>

        <label for="exampleInputEmail1">Price</label>
        <input type="text" name="price" value= "{{$menu->price}}" class="form-control"><br>
        <span style="color: red">@error('price'){{$message}}@enderror</span><br>

        
        <label for="exampleInputEmail1">Image</label>
        <div class="col-sm-12 col-md-3 col-lg-3">
                            <a class="lightbox">
                                <img class="img-fluid" src="{{asset('images/'.$menu->image)}}" alt="Gallery Images">
                            </a>
        
        </div>
            <input name = "image" type="file" class="form-control w-25" id="exampleInputEmail1" class="form-control" aria-describedby="emailHelp" value= "{{$menu->image}}" >
            <span style="color: red">@error('image'){{$message}}@enderror</span><br>
       
        <input type="submit" value="Submit"><br>
    </form>
</body>
</html>
</div>
@endsection