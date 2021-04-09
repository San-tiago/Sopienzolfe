
@extends('layouts.admin_layout')

@section('dashboard')

<h1 class = "pending-order-h1">Pending Orders</h1>

@if(session('adminmessage_sent'))
    <div class="d-flex h-25 justify-content-center alert alert-success" role="alert">
        <h5>{{Session::get('adminmessage_sent')}}</h5>
    </div>
@endif
<div class="main-section">
    
  <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        From Customer
      </button>
      <div class="dropdown-menu">
          @foreach($users as $user)
          <a href="{{url('/admin/pending-order/'.$user->email)}}" class ="dropdown-item">
          {{$user->email}}
          </a>
          @endforeach
      </div>
  </div>


  <div class="col-md-12">
              <div class="card">
                
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Food Name
                        </th>
                        <th>
                          Category
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                        Quantity
                        </th>
                        <th>
                         Price
                        </th>
                        
                      </thead>
                      <tbody>
                      @foreach($pending_orders as $pending_order)
                        <tr>
                            <td>{{$pending_order->menu_name}}</td>
                            <td >{{$pending_order->menu_category}}</td>
                            <td>{{$pending_order->menu_description}}</td>
                            <td>{{$pending_order->quantity}}</td>
                            <td>{{$pending_order->menu_price}}</td>  
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection