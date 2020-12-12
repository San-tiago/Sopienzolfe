@extends('layouts.app')

@section('content')
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
    <span style="color: red">@error('receiver_name'){{$message}}@enderror</span>

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input  name= "receiveraddress" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Address">
    <span style="color: red">@error('receiver_address'){{$message}}@enderror</span>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlSelect1">Province</label>
    <select class="form-control" id="exampleFormControlSelect1" name="province">
      <option>CALABARZON</option>

    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">City/Municipality</label>
    <select class="form-control" id="exampleFormControlSelect1" name="municipality/city">
      <option>CALABARZON</option>
      
    </select>
  </div>

  
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number</label>
    <input name="receivercontactnumber"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Number">
    <span style="color: red">@error('receiver_contactnumber'){{$message}}@enderror</span>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection
