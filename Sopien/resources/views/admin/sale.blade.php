@extends('layouts.admin_layout')

@section('dashboard')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">Pending Order</p>
                        <h3 class="card-title">0
                        
                        </h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                        </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">Pending Order</p>
                        <h3 class="card-title">0
                        
                        </h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                        
                        </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">Pending Order</p>
                        <h3 class="card-title">0
                        
                        </h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                        
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-section">
    
  <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Menu
      </button>
      <div class="dropdown-menu">
          @foreach($menus as $menu)
          <a href="{{url('/menu/sales/'.$menu->id)}}" class ="dropdown-item">
          {{$menu->food_name}}
          </a>
          @endforeach
      </div>
  </div>


  <div class="col-md-12">
              <div class="card">
              <div class="card-header card-header-primary">
                  <h4 class="card-title ">Today Sales</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Food Item
                        </th>
                        <th>
                          Category
                        </th>
                        <th>
                          Quantity
                        </th>
                        <th>
                        Total Price
                        </th>
                        <th>
                         Date
                        </th>
                        
                      </thead>
                      <tbody>
                      @foreach($orders_today as $order_today)
                        <tr>
                            <td>{{$order_today->menu_name}}</td>       
                            <td>{{$order_today->menu_category}}</td>       
                            <td>{{$order_today->quantity}}</td>       
                            <td>{{$order_today->menu_price}}</td>   
                            <td>{{$order_today->created_at}}</td>      
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>






            <div class="col-md-12">
              <div class="card">
              <div class="card-header card-header-primary">
                  <h4 class="card-title ">Monthly Sales</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Food Item
                        </th>
                        <th>
                          Category
                        </th>
                        <th>
                          Quantity
                        </th>
                        <th>
                        Total Price
                        </th>
                        <th>
                         Date
                        </th>
                        
                      </thead>
                      <tbody>
                      @foreach($orders_month as $order_month)
                        <tr>
                        <td>{{$loop->index+1}}</td>      
                            <td>{{$order_month->menu_name}}</td>       
                            <td>{{$order_month->menu_category}}</td>       
                            <td>{{$order_month->quantity}}</td>       
                            <td>{{$order_month->menu_price}}</td>   
                            <td>{{$order_today->created_at}}</td>         
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>



    
@endsection