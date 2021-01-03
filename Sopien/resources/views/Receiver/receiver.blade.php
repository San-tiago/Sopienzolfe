@extends('layouts.app')

@section('content')
<ul class="messages">
    </ul>

<div class="d-flex justify-content-center">

<form action="{{url('/receiver')}}" method="post">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">From</label>
    <input name = "fromemail" type="email" value="{{ Auth::user()->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Receiver Name</label>
    <input name = "receivername" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Receiver Name">
    <span style="color: red">@error('receivername'){{$message}}@enderror</span>

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input  name= "receiveraddress" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address">
    <span style="color: red">@error('receiveraddress'){{$message}}@enderror</span>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlSelect1">Province / Region</label>
    <select class="form-control" id="province" name="province">

      <option>NCR</option>

    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">City/Municipality</label>
    <select class="form-control" id="message" name="municipality/city">
      
      
    </select>
  </div>

  
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number</label>
    <input name="receivercontactnumber"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Number">
    <span style="color: red">@error('receivercontactnumber'){{$message}}@enderror</span>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection
