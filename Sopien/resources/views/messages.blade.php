@extends('layouts.menu')

@section('content')
<div class="d-flex justify-content-center shadow-sm p-4 mb-4 bg-white w-50 h-25 flex-wrap mx-auto rounded">
    <h3 class="text-dark">Messages</h3>
    
</div>

<div class="d-flex justify-content-center flex-column">
@foreach($messages as $message)
    <div class="d-flex justify-content-center w-50 h-75 align-self-center p-3 border d-flex flex-wrap flex-column shadow p-4 mb-4 bg-white rounded text-secondary">
        <h5 class ="align-self-center font-weight-bold text-dark">From Admin:</h5><br>
        <p class="text-secondary">{{$message->message}}</p><br>
        <p class="text-secondary">{{$message->created_at}}</p>
    </div>
@endforeach
</div>

@endsection
