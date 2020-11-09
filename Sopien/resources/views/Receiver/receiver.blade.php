
<div>
<form action="{{url('/receiver')}}" method="post">
@csrf

From: <input name = "fromemail" type="text" value="{{ Auth::user()->email }}" readonly><br>
Receiver Name: <input name = "receivername" type="text" placeholder="Fullname"><br>
<span style="color: red">@error('receiver_name'){{$message}}@enderror</span><br>
Address : <input name= "receiveraddress" type="text" placeholder="Address"><br>
<span style="color: red">@error('receiver_address'){{$message}}@enderror</span><br>
Contact Number: <input type="text" name="receivercontactnumber" placeholder="Contact Number"><br>
<span style="color: red">@error('receiver_contactnumber'){{$message}}@enderror</span><br>


<input type="submit" value = "Place Order">

    
</form>
</div>
