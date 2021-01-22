@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Create Menu</h1>


    <form action="{{url('/insert-fooditem')}}" method="post" enctype="multipart/form-data">
        @csrf        
    <div class="form-group">
        <label for="exampleInputEmail1">Food Name</label>
        <input name = "food_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Food Name">
        <span style="color: red">@error('food_name'){{$message}}@enderror</span><br>
    </div>

    
        <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="exampleFormControlSelect1" name="menu_category">
            @foreach($categories as $category)  
                <option>{{$category->category}}</option>
            @endforeach
            </select>
        </div>

    

        <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <input name = "description" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Description">
            <span style="color: red">@error('description'){{$message}}@enderror</span><br>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input name = "price" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price">
            <span style="color: red">@error('price'){{$message}}@enderror</span><br>
        </div>

        <div class="form-group d-flex flex-column" >
            <label>Image</label>
            <input name = "image" type="file" class="form-control w-25" id="exampleInputEmail1" aria-describedby="emailHelp">
            <span style="color: red">@error('image'){{$message}}@enderror</span><br>
        </div>
    
        <input type="submit" name="" value="Submit"  class="btn btn-outline-primary">
        

    </form>
</div>
@endsection