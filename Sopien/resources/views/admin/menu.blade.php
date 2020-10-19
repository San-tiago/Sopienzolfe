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

        
       
</table>

    <a href="/admin/categories"><button>Categories</button></a>
    <a href=""><button>Add Food Item</button></a>

    

</div>
@endsection