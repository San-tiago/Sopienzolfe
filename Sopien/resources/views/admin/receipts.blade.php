
@extends('layouts.admin_layout')

@section('dashboard')

<h1 class = "pending-order-h1">Order Receipts</h1>



<div class="main-section">
    
  <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    From Customer
  </button>
  <div class="dropdown-menu">
        @foreach($users as $user)
        <a href="{{url('/admin/customer-receipts/'.$user->id.'/'.$user->email)}}" class ="dropdown-item">
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
                          Receipt Name
                        </th>
                        <th>
                          Date
                        </th>                        
                      </thead>
                      <tbody>
                    @foreach($receipts as $receipt)
                        <tr>
                            <td >{{$receipt->receipt_name}}</td>
                            <td>{{$receipt->created_at}}</td>
                            

                        </tr>
                    @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection