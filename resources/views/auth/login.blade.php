@extends('layouts.master')

@section('title', 'Reviews - Login')

@section('content')

<h1>Login</h1>
<br>
<p>You must be logged in to use the system. You can register with the system <a href="{{'register'}}">here</a></p>
@foreach (['danger'] as $message)
        @if(Session::has('alert-'.$message))
            <p class="alert alert-{{$message}}">{{ Session::get('alert-'.$message) }}</p>
        @endif
@endforeach
<div class="alert alert-info" role="alert">
<p>If you have already registered, make sure you've verified your account before logging into the system.</p>
</div>
<div>
<form action="{{url('login')}}" method="POST">
{{ csrf_field() }}
<label for="username">Username:</label>
<input type="text" name="username" id="username" value="{{old('username')}}">
<br>
<label for="password">Password:</label>
<input type="password" name="password" id="password">
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Login">
</form>
</div>

@endsection