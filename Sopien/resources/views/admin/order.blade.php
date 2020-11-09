@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Orders</h1>

<table>
        <tr>
           <th>id</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        
        @foreach($users as $user)
        <tr>

            <td>{{$loop->index+1}}</td>
          
            <td>{{$user->email}}</td>
            <td> <a href="{{url('admin/order/'.$user->email)}}">  View Orders</a> </td>       
        </tr>
        @endforeach

</table>


    

</div>
@endsection