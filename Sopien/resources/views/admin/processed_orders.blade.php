
@extends('layouts.admin_layout')
@section('dashboard')
    
<h1 class = "pending-order-h1">In-Process Orders</h1>
<div class="main-section">
    
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Partially Paid
        </button>
      <div class="dropdown-menu">
            @foreach($users as $user)
              @if($user->amount_paid == 'Partial')
              <a href="{{url('/admin/process-order/'.$user->email)}}" class ="dropdown-item">
              {{$user->email}}
              </a>
              @endif
            @endforeach
        </div>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Fully Paid
        </button>
      <div class="dropdown-menu">
            @foreach($users as $user)
              @if($user->amount_paid == 'Full')
              <a href="{{url('/admin/process-order/'.$user->email)}}" class ="dropdown-item">
              {{$user->email}}
              </a>
              @endif
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
                      @foreach($processed_orders as $processed_order)
                        <tr>
                            <td>{{$processed_order->menu_name}}</td>
                            <td >{{$processed_order->menu_category}}</td>
                            <td>{{$processed_order->menu_description}}</td>
                            <td>{{$processed_order->quantity}}</td>
                            <td>{{$processed_order->menu_price}}</td>  
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

@endsection
