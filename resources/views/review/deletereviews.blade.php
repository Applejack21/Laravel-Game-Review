@extends('layouts.master')
@section('title', 'Reviews - Delete Reviews')
@section('content')

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
    <input type="submit" name="submitBtn" value="Delete Reviews">
</form>

@endsection