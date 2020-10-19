@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Categories</h1>
<a href="{{url('/admin/add-category')}}"><button>Add Category</button></a>

<table>
        <tr>
           
            <th>Category Name</th>
            <th>Action</th>
        </tr>

        
       
</table>

    

</div>
@endsection