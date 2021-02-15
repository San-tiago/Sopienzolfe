@extends('layouts.admin_layout')
@section('dashboard')
<div>
<h1>Add Category</h1>

<form action="{{url('/insert-category')}}" method="post">
        @csrf
        Category Name:<input type="text" class="form-control @error('address') is-invalid @enderror" name="category" value="{{ old('category') }}">
        <span style="color: red">@error('category'){{$message}}@enderror</span><br>
     <input type="submit" name="" value="Submit"  class="btn btn-outline-primary">
    </form>


    

</div>
@endsection