@extends('layouts.master')
@section('title', 'Reviews - List of Reviews')
@section('content')

<h1>List of Reviews</h1>

@foreach ($reviews as $review)
<a id="hyperlink" href="{{url('details/'.$review->id)}}">
<div class="alert alert-info" role="alert">
<p>{{\Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}} - {{$review->review_title}}</p>
<p>Reviewed By: {{$review->review_by}}</p>
</div>
</a>
@endforeach
@endsection