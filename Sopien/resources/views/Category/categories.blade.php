@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Categories</h1>
<a href="{{url('/admin/add-category')}}"><button class="btn btn-outline-primary">Add Category</button></a><br>


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

    

</div>
@endsection