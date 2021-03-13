@extends('layouts.admin_layout')
@section('dashboard')
<div class="col-md-12">
              <div class="card">
              <div class="card-header card-header-primary">
                  <h4 class="card-title ">{{$menu_name}}</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th >ID</th>
                        <th >Food Item</th>
                        <th >Total Price</th>
                        <th >Quantity</th>
                        <th >Date</th>
                      </thead>
                      <tbody>
                      @foreach($menu_details as $menu_detail)
                        <tr>
                        <td >{{$menu_detail->id}}</td>
                        <td >{{$menu_detail->menu_name}}</td>
                        <td >{{$menu_detail->menu_price}}</td>
                        <td >{{$menu_detail->quantity}}</td>
                        <td >{{$menu_detail->created_at}}</td>   
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                    <h3>Total : {{$menusales_sum}}</h3>
                  </div>
                </div>
              </div>
            </div>
@endsection