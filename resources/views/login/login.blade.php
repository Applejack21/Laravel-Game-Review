@extends('layouts.master')

@section('title', 'Reviews - Login')

@section('content')

@if (session('loginError'))
    <div>
        {{ session('loginError') }}
    </div>
@endif
<h1>Login</h1>
<br>
<div>
<form action="{{url('login')}}" method="POST">
{{ csrf_field() }}
<label for="email">Email Address:</label>
<input type="text" name="email" id="email" value="{{old('email')}}">
<br>
<label for="password">Password:</label>
<input type="password" name="password" id="password">
<br>
<label for="remember">Remember Me?</label>
<input type="checkbox" name="remember" id="remember" value="1">
<small id="rememberHelpInline" class="text-muted">
Remembers you until you manually logout.
</small>
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Login">
</form>
</div>

@endsection