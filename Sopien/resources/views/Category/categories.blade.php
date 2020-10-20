@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Categories</h1>
<a href="{{url('/admin/add-category')}}"><button>Add Category</button></a><br>


<table>
        <tr>
           <th>id</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>

        @foreach($categories as $category)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$category->category}}</td>
            <td> <a href="{{url('category/edit/'.$category->id)}}">  Edit</a> </td>
            <td><a href="{{url('category/delete/'.$category->id)}}">  Delete</a></td>
            
        </tr>
        @endforeach

</table>

    

</div>
@endsection