@extends('layouts.admin_layout')

@section('dashboard')

@foreach($messages as $message)
    <div class="container">
    
            <h5>From: {{$message->from_useremail}}</h5>
            <p>{{$message->message}}</p>
            <span class="time-right">{{date('m/d/Y h:i:s a', strtotime($message->created_at))}}</span>
    </div>
@endforeach


@endsection