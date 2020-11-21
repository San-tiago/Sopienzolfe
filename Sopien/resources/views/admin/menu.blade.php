@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Menu</h1>
    
<table class="table table-bordered">
     <thead>
         <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Food Name</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Price</th>
            <th scope="col"colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
     <tbody>
     @foreach($menus as $menu)
        <tr>
            <td class="text-center">{{$loop->index+1}}</td>
            <td class="text-center">{{$menu->food_name}}</td>
            <td class="text-center">{{$menu->menu_category}}</td>
            <td class="text-center">{{$menu->description}}</td>
            <td class="text-center">{{$menu->price}}</td>
            <td class="text-center"> <a href="{{url('/menu/edit/'.$menu->id)}}"><button class="btn btn-info btn-sm">Edit</button></a> </td>
            <td class="text-center"><a href="{{url('/menu/delete/'.$menu->id)}}"><button class="btn btn-danger btn-sm">Delete</button></a></td>
            
        </tr>
        @endforeach
        
    </table>

    <a href="{{url('/admin/categories')}}"><button  class="btn btn-outline-primary">Categories</button></a>
    <a href="{{url('/admin/add-fooditem')}}"><button  class="btn btn-outline-primary">Add Food Item</button></a>

    

</div>
@endsection