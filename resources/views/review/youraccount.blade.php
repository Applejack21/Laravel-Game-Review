@extends('layouts.master')
@section('title', 'Review - Your Account')
@section('content')

    <h1>Your Account</h1>
<p>This page shows your different interactions with the system itself, as well as change inforation about your account.</p>
<br>
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            <b>Please check the errors below and correct them:</b>
            <br>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            <br>
            @endforeach
        </ul>
    </div>
@endif
<div class="message">
    @foreach (['success'] as $message)
        @if(Session::has('alert-'.$message))
            <p class="alert alert-{{$message}}">{{ Session::get('alert-'.$message) }}</p>
        @endif
    @endforeach
    
    @foreach (['danger'] as $message)
        @if(Session::has('alert-'.$message))
            <p class="alert alert-{{$message}}">{{ Session::get('alert-'.$message)}}</p>
        @endif
    @endforeach
</div>

@endsection