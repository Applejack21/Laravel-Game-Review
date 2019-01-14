@extends('layouts.master')
@section('title', 'Reviews - View Review')
@section('content')

<h1 id="reviewheader">{{$reviews->review_title}}</h1>
<ul>
<li>Created At: {{\Carbon\Carbon::parse($reviews->created_at)->format('d/m/Y - H:i')}}</li>
<br>

<li>Updated At: {{\Carbon\Carbon::parse($reviews->updated_at)->format('d/m/Y - H:i')}}</li>
<br>

<li>Reviewed By: {{$reviews->review_by}}</li>
<br>
    
<li>Game Reviewed: {{$reviews->game_title}}</li>
<br>
</ul>

<div id="reviewtext">
<h2 id="reviewtexthead">Review Text:</h2>
<p>
{{$reviews->review_desc}}
<br>
    
Overall rating: {{$reviews->review_rating}} out of 5
</p>
</div>

<div id="reviewcomment">
<h2 id="reviewcommentshead">Add a comment:</h2>
<br>
@if (Auth::check())
<form action="{{url('addcoment')}}" method="POST">
{{ csrf_field() }}
<label for="username">Username:</label>
<input type="text" name="username" value="{{old('username')}}" id="username">
<br>
<label for="comment">Comment:</label>
<textarea id="comment" name="comment">{{old('comment')}}</textarea>
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Add comment">
</form>
@else
<p>Please login to leave a comment</p>
</div>

@endif
@endsection