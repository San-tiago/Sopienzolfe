@extends('layouts.admin_layout')

@section('dashboard')
<div>
<h1>Categories</h1>


@if(session('category_added'))
    <div class="d-flex justify-content-center alert alert-success" role="alert">
        <h5>{{Session::get('category_added')}}</h5>
    </div>
@elseif(session('delete'))
<div class="d-flex justify-content-center alert alert-danger" role="alert">
        <h5>{{Session::get('delete')}}</h5>
    </div>
@endif
<table class="table table-bordered">
     <thead>
         <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Category Name</th>
            <th scope="col" class="text-center" colspan="3">Action</th>
            
        </tr>
    </thead>
     <tbody>
     @foreach($categories as $category)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$category->category}}</td>
            <td class="text-center"> <a href="{{url('category/edit/'.$category->id)}}"> <button class="btn btn-info btn-sm">Edit</button></a> </td>
            <td class="text-center"><a href="{{url('category/delete/'.$category->id)}}">  <button class="btn btn-danger btn-sm">Delete</button></a></td>
            
        </tr>
        @endforeach
        
    </table>
    <a href="{{url('/admin/add-category')}}"><button class="btn btn-outline-primary">Add Category</button></a>
    @if($categories!=null)
        <a href="{{url('/admin/add-fooditem')}}"><button  class="btn btn-outline-primary">Add Food Item</button></a>
    @endif

</div>
@endsection