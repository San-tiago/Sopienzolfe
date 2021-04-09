
@extends('layouts.admin_layout')
@section('dashboard')
<div>
<h1>Menu</h1>
@if(session('menu'))
    <div class="d-flex h-25 justify-content-center alert alert-success" role="alert">
        <h5>{{Session::get('menu')}}</h5>
    </div>
@elseif(session('delete'))
    <div class="d-flex h-25 justify-content-center alert alert-danger" role="alert">
        <h5>{{Session::get('delete')}}</h5>
    </div>
@elseif(session('edit'))
    <div class="d-flex h-25 justify-content-center alert alert-info" role="alert">
        <h5>{{Session::get('edit')}}</h5>
    </div>
@endif
<table class="table table-bordered">
     <thead>
         <tr>
            <th scope="col" class="text-center">Image</th>
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
            <td class="text-center"><div class="col-sm-12 col-md-3 col-lg-3">
                            <a class="lightbox">
                                <img class="img-fluid" src="{{asset('images/'.$menu->image)}}" alt="Gallery Images">
                            </a>
        
        </div></td>
            <td class="text-center">{{$menu->food_name}}</td>
            <td class="text-center">{{$menu->menu_category}}</td>
            <td class="text-center">{{$menu->description}}</td>
            <td class="text-center">{{$menu->price}}</td>
            <td class="text-center"> <a href="{{url('/menu/edit/'.$menu->id)}}"><button class="btn btn-info">Edit</button></a></td>
            <td class="text-center"><a href="{{url('/menu/delete/'.$menu->id)}}"><button class="btn btn-danger">Delete</button></a></td>
            
        </tr>
        @endforeach
        
    </table>

    <a href="{{url('/admin/categories')}}"><button  class="btn btn-outline-primary">Categories</button></a>
    @if(count($category) != 0)
    <a href="{{url('/admin/add-fooditem')}}"><button  class="btn btn-outline-primary">Add Food Item</button></a>
    @endif


    

</div>
@endsection