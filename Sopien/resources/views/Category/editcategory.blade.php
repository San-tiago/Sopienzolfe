@extends('layouts.admin_layout')
@section('dashboard')
<div>
<h1>Edit Category</h1>

<form action="{{url('/category/update/'.$category->id)}}" method="post">
        @csrf
        Category Name: <input type="text" name="category" value="{{$category->category}}"><br>
        <span style="color: red">@error('category'){{$message}}@enderror</span><br>

        <input type="submit" name="" value="Submit"><br>
    </form>


    

</div>
@endsection