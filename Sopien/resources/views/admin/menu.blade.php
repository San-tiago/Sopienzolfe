@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Menu</h1>
    
<table>
        <tr>
           
            <th>Category</th>
            <th>Food Name</th>
            <th>Description</th>
            <th>Price</th> 
            <th>Action</th>
        </tr>
        @foreach($menus as $menu)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$menu->food_name}}</td>
            <td>{{$menu->menu_category}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->price}}</td>
            <td> <a href="{{url('/menu/edit/'.$menu->id)}}">  Edit</a> </td>
            <td><a href="{{url('/menu/delete/'.$menu->id)}}">  Delete</a></td>
            
        </tr>
        @endforeach

        
       
</table>

    <a href="{{url('/admin/categories')}}"><button>Categories</button></a>
    <a href="{{url('/admin/add-fooditem')}}"><button>Add Food Item</button></a>

    

</div>
@endsection