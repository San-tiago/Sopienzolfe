
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
                      @foreach($filtered_pendingorders as $filtered_pendingorder)
                        <tr>
                            <td>{{$filtered_pendingorder->menu_name}}</td>
                            <td >{{$filtered_pendingorder->menu_category}}</td>
                            <td>{{$filtered_pendingorder->menu_description}}</td>
                            <td>{{$filtered_pendingorder->quantity}}</td>
                            <td>{{$filtered_pendingorder->menu_price}}</td>  
                        </tr>
                        @endforeach
                        <tr col-span="5">
                            <td><h3>Total: P {{$total_filtered_pendingorders}}</h3></td>
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
  Approve Order
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{url('/receipt/pdf/'.$filtered_pendingorder->email.'/'.$filtered_pendingorder->user_id)}}" method="post">
        @csrf
              
              <div class="form-group" id="payment">
                  Amount Paid: 
                  <select class="form-control" id="exampleFormControlSelect1" name="amount_paid">
              
                    <option class="dropdown-item" value="Partial">Partial</option>
                    <option class="dropdown-item" value="Full">Full</option>
                </select>
                </div>
      
                <p id="text">Receipt generated, click Approve Button</p>

        </div>
            <div class="modal-footer">
             <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
       
                <a href="{{url('/admin/approving-order/'.$filtered_pendingorder->order_id.'/'.$filtered_pendingorder->email)}}">
                    <button type="button" class="btn btn-primary " id="approveButton">Confirm</button>
                </a>
             
              
                  <input type="submit" id = "generateButton" class="btn btn-outline-primary" value = "Generate Receipt" onclick="generate()">
           
                 
    
        </form>
      </div>
    </div>
  </div>
</div>
    
   

   <!--      <form action="{{url('/decline-order/'.$filtered_pendingorder->order_id.'/'.$filtered_pendingorder->email)}}" method="POST">
        @csrf
            <div class="input-group mb-3">
                    <input type="text" name = "message"class="form-control" placeholder="Send message" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-danger" type="submit" value = "Decline Order">
                    </div>
                    
                </div>
        </form> -->
<!--         <a href="{{url('/decline-order/'.$filtered_pendingorder->order_id.'/'.$filtered_pendingorder->email)}}"><button class="btn btn-danger" type="submit">Decline Order</button></a>
 -->        
      <!-- Button trigger modal -->
      
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelOrderModal">
          Decline Order
        </button>
      

<!-- Modal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Decline Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{url('/decline-order/'.$filtered_pendingorder->order_id.'/'.$filtered_pendingorder->email)}}" method="post">
        @csrf
        <label for="exampleInputEmail1">Message:</label>
        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Enter message" name="message">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="">
          <button type="submit" class="btn btn-primary">Confirm</button>
        </a>
      </form>
      </div>
    </div>
  </div>
</div>
        
        @if(session('adminmessage_sent'))
            <div class="d-flex justify-content-center alert alert-success" role="alert">
             <h5>{{Session::get('adminmessage_sent')}}</h5>
            </div>
         @endif
</div>



<script>
let approveButton = document.getElementById("approveButton");
let generateButton = document.getElementById("generateButton");
let payment = document.getElementById("payment");
let text = document.getElementById("text");
approveButton.style.display = "none";
text.style.display = "none";

  function generate(){
    approveButton.style.display = "block";
    text.style.display = "block";
    generateButton.style.display = "none";
    payment.style.display = "none";

  }
</script>
@endsection