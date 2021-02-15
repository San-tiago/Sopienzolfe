
@extends('layouts.admin_layout')
@section('dashboard')
<div>


<h1>On Delivery Orders</h1>
       

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
                      @foreach($filtered_ondeliveryorders as $filtered_ondeliveryorder)
                        <tr>
                            <td>{{$filtered_ondeliveryorder->menu_name}}</td>
                            <td >{{$filtered_ondeliveryorder->menu_category}}</td>
                            <td>{{$filtered_ondeliveryorder->menu_description}}</td>
                            <td>{{$filtered_ondeliveryorder->quantity}}</td>
                            <td>{{$filtered_ondeliveryorder->menu_price}}</td>  
                        </tr>
                        @endforeach
                        <tr col-span="5">
                            <td><h3>Total: P {{$total_filtered_ondeliveryorders}}</h3></td>
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
  Mark As Received 
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
        Are you sure you want to mark as received this order?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{url('/admin/receiving-order/'.$filtered_ondeliveryorder->order_id.'/'.$filtered_ondeliveryorder->email)}}">
            <button type="button" class="btn btn-primary">Confirm</button>
         </a>
      </div>
    </div>
  </div>
</div>
    
   







@endsection