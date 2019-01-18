@extends('layouts.master')
@section('title', 'Reviews - Delete Reviews')
@section('content')
<div class="message">
    @foreach (['success'] as $message)
        @if(Session::has('alert-'.$message))
            <p class="alert alert-{{$message}}">{{ Session::get('alert-'.$message) }}</p>
        @endif
    @endforeach
</div>

<h1>Delete Reviews</h1>
<br>

<form action="{{url('deletereviews')}}" method="POST">
    {{ csrf_field() }}
     @foreach ($reviews as $review)
        <div>
            <label>{{$review->review_title}}</label>
            <input type='checkbox' value='{{$review->id}}' name='reviews[]'/>
        </div>
    @endforeach
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Add comment">
</form>

@endsection