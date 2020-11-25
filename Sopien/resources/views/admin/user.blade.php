@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>users</h1>


<table class="table table-bordered">
        <thead>
         <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center"> Email</th>
            <th scope="col" class="text-center"> Address</th>
            <th scope="col" class="text-center">Contact Number</th>
            <th scope="col" class="text-center">Count of Completed Orders</th>
            <th scope="col" class="text-center">Count of Cancelled Orders</th>
            <th scope="col" class="text-center">Account Status</th>
            <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
     <tr>
        <td class="text-center">{{$user->id}}</td>
        <td class="text-center">
            @if($user->isOnline())
                <i class="fas fa-user fa-lg active-user"></i>
            @else
                <i class="fas fa-user-alt-slash offline-user fa-lg"></i>
            @endif
            {{$user->email}}
        </td>
        <td class="text-center">{{$user->address}}</td>
        <td class="text-center">{{$user->contactnumber}}</td>
        <td class="text-center">{{$user->completed_orders_count}}</td>
        <td class="text-center">{{$user->cancelled_orders_count}}</td>

        @if($user->Account_Status === 'Active')
            <td class="text-center"><p class="btn text-success txt-sm">{{$user->Account_Status}}</p></td>
        @else
        <td class="text-center"><p class="btn text-danger txt-sm">{{$user->Account_Status}}</p></td>

        @endif


        @if($user->Account_Status === 'Active')
            <td class="text-center"><a href="{{url('/admin/deactivate_account/'.$user->id)}}"><button class="btn btn-danger btn-sm">Deactivate</button></a></td>

        @else
            <td class="text-center"><a href="{{url('/admin/activate_account/'.$user->id)}}"><button class="btn btn-success btn-sm">Activate</button></a></td>
        @endif
        </tr>
        @endforeach
        </tbody>
    </table>


    

</div>
@endsection