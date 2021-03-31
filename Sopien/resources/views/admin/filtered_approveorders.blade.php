
@extends('layouts.admin_layout')
@section('dashboard')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Orders Details</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Email
                        </th>
                        <th>
                          Receiver Name
                        </th>
                        <th>
                          Payment Type
                        </th>
                        <th>
                          Address
                        </th>
                        <th>
                        Municipality/City
                        </th>
                        <th>
                         Province/Region
                        </th>
                        <th>
                         Contact Number
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                        <td>{{$details['fromemail']}}</td>
                        <td >{{$details['receivername']}}</td>
                        <td >{{$details['payment_type']}}</td>
                        <td >{{$details['receiveraddress']}}</td>
                        <td >{{$details['municipality/city']}}</td>
                        <td >{{$details['province']}}</td>
                        <td >{{$details['receivercontactnumber']}}</td>  
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
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
                         Sub Total
                        </th>
                        
                      </thead>
                      <tbody>
                      @foreach($filtered_approveorders as $filtered_approveorder)
                        <tr>
                            <td>{{$filtered_approveorder->menu_name}}</td>
                            <td >{{$filtered_approveorder->menu_category}}</td>
                            <td>{{$filtered_approveorder->menu_description}}</td>
                            <td>{{$filtered_approveorder->quantity}}</td>
                            <td>{{$filtered_approveorder->menu_price}}</td>  
                        </tr>
                        @endforeach
                        <tr class="mt-5">
                          <td>Shipping Fee: P150</td>
                        </tr>
                        <tr col-span="5">
                            <td><h3>Total: P {{$total_filtered_approveorders + 150}}</h3></td>
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Process Order
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Process Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to process this order?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{url('/admin/processing-order/'.$filtered_approveorder->order_id.'/'.$filtered_approveorder->email)}}">
            <button type="button" class="btn btn-primary">Confirm</button>
         </a>
      </div>
    </div>
  </div>
</div>
    
   






@endsection