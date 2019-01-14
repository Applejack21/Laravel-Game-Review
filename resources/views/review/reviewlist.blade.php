@extends('layouts.master')
@section('title', 'Reviews - List of Reviews')
@section('content')

<h1>List of Reviews</h1>

@foreach ($reviews as $review)
        <p>
            <i class="fa fa-caret-right"></i>
            <a href="{{url('details/'.$review->id)}}">{{$review->review_title}} </a>
            <br>
            Reviewed By: {{$review->review_by}}
            <br>
            Date Posted: {{\Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}
        </p>
@endforeach
@endsection