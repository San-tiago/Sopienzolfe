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
                  <h3 class="card-title">{{$pendingorder_count}}
                   
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
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Received Order</p>
                  <h3 class="card-title">{{$receivedorder_count}}</h3>
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
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Cancelled Orders</p>
                  <h3 class="card-title">{{$cancelledorder_count}}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <p class="card-category">Users</p>
                  <h3 class="card-title">{{$user_count}}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                 
                  </div>
                </div>
              </div>
            </div>
          </div>
          

@endsection