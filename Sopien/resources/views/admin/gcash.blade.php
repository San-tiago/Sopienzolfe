@extends('layouts.admin_layout')

@section('dashboard')
<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>G-Cash Configuration</h1>
				</div>
			</div>
		</div>
</div>




@if(count($gcash) == 0)

	<div class="d-flex p-2 justify-content-center w-100 m-auto">
	<form action="{{url('/gcash-upload')}}" method="post" enctype="multipart/form-data">
		@csrf
		<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="gcash_contactnumber">
		<input name="gcash_image" type="file" class="form-control w-25" id="exampleInputEmail1" aria-describedby="emailHelp">
		<button type="submit" class="btn btn-primary">UPLOAD</button>	
	</form>
	</div>
@else 
	<div class="d-flex p-2 justify-content-center w-50 m-auto">
	<div class="h-25">
	@foreach($gcash as $gcash)
	<form action="{{url('/gcash-update/'.$gcash->id)}}" method="post" enctype="multipart/form-data">
		@csrf
	<img class="card-img-top mb-3" src="{{asset('../images/'.$gcash->gcash_image)}}"  alt="Card image cap">
	<label for="exampleInputEmail1">Gcash Number</label>
	<input type="text" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="gcash_contactnumber" value="{{$gcash->gcash_contactnumber}}">
	<span style="color: red">@error('gcash_contactnumber'){{$message}}@enderror</span><br>

	<input name="gcash_image" type="file" class="form-control w-25 mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">
	<span style="color: red">@error('gcash_image'){{$message}}@enderror</span><br>

	@endforeach
	<button type="submit" class="btn btn-primary">SAVE</button>	
	</form>
	</div>

@endif





@endsection