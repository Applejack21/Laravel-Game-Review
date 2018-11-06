@extends('layouts.master')
@section('title', 'Reviews - Register')
@section('content')

<h1>Register</h1>
<br>
<p>If you already have an account, you can log in <a href="{{'login'}}">here</a></p>
    @if (count($errors) > 0)
<div>
    <p><b>Please check the errors below and correct them:</b></p>
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            <br>
        @endforeach
    </ul>
</div>
<div class="message">
    @foreach (['success'] as $message)
        @if(Session::has('alert-'.$message))
            <p class="alert alert-{{$message}}">{{ Session::get('alert-'.$message) }}</p>
        @endif
    @endforeach
</div>
@endif
<br>
<div>
<form action="{{url('register')}}" method="POST">
{{ csrf_field() }}
<label for="first_name">First Name:</label>
<input type="text" name="first_name" value="{{old('first_name')}}" id="first_name">
<br>
<label for="last_name">Last Name:</label>
<input type="text" name="last_name" value="{{old('last_name')}}" id="last_name">
<br>
<label for="username">Username:</label>
<input type="text" name="username" value="{{old('username')}}" id="username">
<small id="usernameHelpInline" class="text-muted">
Minimum of 3 characters, maximum of 10.
</small>
<br>
<label for="email">Email:</label>
<input type="email" name="email" value="{{old('email')}}" id="email">
<br>
<label for="password">Password:</label>
<input type="password" name="password" id="password" maxlength="15">
<small id="passwordHelpInline" class="text-muted">
Must be 8-15 characters long and contain at least one uppercase/lowercase letters and one number.
</small>
<br>
<label for="password_confirmation">Confirm Password:</label>
<input type="password" name="password_confirmation" id="password_confirmation" maxlength="15">
<br>
<br>
    
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Register">
</form>
</div>
<br>
<br>
@endsection