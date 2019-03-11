@extends('layouts.master')
@section('title', 'Reviews - Delete Reviews')
@section('content')

<h1>Delete Reviews</h1>
<p>As an admin, you can delete reviews here. Select the ones you want to delete below:</p>
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

<form action="{{url('deletereviews')}}" method="POST">
    {{ csrf_field() }}
     @foreach ($reviews as $review)
        <div class="alert alert-info" role="alert" style=width:750px;>
            <label>{{$review->review_title}}</label>
            <input type="checkbox" value="{{$review->id}}" name="reviews[]" id="reviews"/>
        </div>
    @endforeach
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Delete selected reviews">
</form>

@endsection