@extends('layouts.dashboard')

@section('dashboard')
<div>

<h1>{{$menu_name}}</h1>

<table class="table table-bordered">
        <thead>
         <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Food Item</th>
            <th scope="col" class="text-center">Total Price</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($menu_details as $menu_detail)
     <tr>
        <td class="text-center">{{$menu_detail->id}}</td>
        <td class="text-center">{{$menu_detail->menu_name}}</td>
        <td class="text-center">{{$menu_detail->menu_price}}</td>
        <td class="text-center">{{$menu_detail->quantity}}</td>
        <td class="text-center">{{$menu_detail->created_at}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <h1>Total : {{$menusales_sum}}</h1>
    

</div>
@endsection