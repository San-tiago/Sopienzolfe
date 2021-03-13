
@extends('layouts.admin_layout')
@section('dashboard')


    





<h1 class = "pending-order-h1">Cancelled Orders</h1>



<div class="main-section">
    
  <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    From Customer
  </button>
  <div class="dropdown-menu">
        @foreach($users as $user)
        <a href="{{url('/admin/customer-cancelled-order/'.$user->id)}}" class ="orders-link">
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
                          #
                        </th>
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
                      @foreach($cancelled_orders as $cancelled_order)
                        <tr>
                        <td>{{$loop->index+1}}</td>
                        <td >{{$cancelled_order->menu_name}}</td>
                        <td >{{$cancelled_order->menu_category}}</td>
                        <td >{{$cancelled_order->menu_description}}</td>
                        <td >{{$cancelled_order->quantity}}</td>
                        <td >{{$cancelled_order->menu_price}}</td>  
                        <td >{{$cancelled_order->created_at}}</td>  
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

@endsection