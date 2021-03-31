@extends('layouts.admin_layout')


@section('dashboard')

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
                      @foreach($orders as $order)
                        <tr>
                            <td>{{$order->menu_name}}</td>
                            <td >{{$order->menu_category}}</td>
                            <td>{{$order->menu_description}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->menu_price}}</td>  
                        </tr>
                        @endforeach
                        <tr>
                          <td>Shipping Fee: 150</td>
                        </tr>
                        <tr col-span="5">
                            <td><h3>Total: P {{$total + 150}}</h3></td>
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

@endsection