
@extends('layouts.admin_layout')

@section('dashboard')

<h1 class = "pending-order-h1">{{$user}} Receipts</h1>



<div class="main-section">
    



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
                        <th>
                          View Receipt
                        </th>                        
                      </thead>
                      <tbody>
                    @foreach($receipts as $receipt)
                        <tr>
                        
                            <td >{{$receipt->receipt_name}}</td>
                            <td>{{$receipt->created_at}}</td>
                            <td class="text-center"> <a href="{{url('/admin/view-receipt/'.$receipt->receipt_name)}}"><button class="btn btn-info">View</button></a></td>
                        </tr>
                    @endforeach
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection