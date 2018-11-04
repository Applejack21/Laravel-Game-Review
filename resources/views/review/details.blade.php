@extends('layouts.master')

@section('title', 'Reviews - View Review')

@section('content')
<h1>{{$reviews->review_title}}</h1>
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

<h3>Review Text:</h3>
<p>
{{$reviews->review_desc}}
<br>
    
Overall rating: {{$reviews->review_rating}} out of 5
</p>

@endsection