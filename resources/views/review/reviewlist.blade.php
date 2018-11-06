@extends('layouts.master')
@section('title', 'Reviews - List of Reviews')
@section('content')

<h1>List of Reviews</h1>

@foreach ($reviews as $review)
        <p>
            <a href="{{url('details/'.$review->id)}}">{{$review->review_title}}</a>           
        </p>
@endforeach
@endsection