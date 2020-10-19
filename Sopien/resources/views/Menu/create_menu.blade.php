@extends('layouts.dashboard')

@section('dashboard')
<div>
<h1>Create Menu</h1>


    <!-- <form action="{{url('/stock-add')}}" method="post">
        @csrf
        Food Name: <input type="text" name="product_name" value="{{ old('product_name') }}"><br>
        <span style="color: red">@error('product_name'){{$message}}@enderror</span><br>

        Size: <input type="text" name="stock" value="{{ old('stock') }}"><br>
        <span style="color: red">@error('stock'){{$message}}@enderror</span><br>

       Category: <select name="" id=""></select>

        Price: <input type="text" name="price" value="{{ old('price') }}"><br>
        <span style="color: red">@error('price'){{$message}}@enderror</span><br>
        <input type="submit" name="" value="Submit"><br>
    </form> -->
</body>
</html>
</div>
@endsection