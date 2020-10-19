@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Add Category</h1>

<form action="{{url('/insert-category')}}" method="post">
        @csrf
        Category Name: <input type="text" name="category" value="{{ old('category') }}"><br>
        <span style="color: red">@error('category'){{$message}}@enderror</span><br>

        <input type="submit" name="" value="Submit"><br>
    </form>


    

</div>
@endsection