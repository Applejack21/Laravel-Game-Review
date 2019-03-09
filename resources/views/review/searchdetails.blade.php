@extends('layouts.master')
@section('title', 'Reviews - Search')
@section('content')

@if($searchTerm == NULL)
<div class="alert alert-danger" role="alert">
<h3>Please input a valid search term.</h3>
</div>
@else

<h2>Search Result(s) for: {{$searchTerm}}</h2>
<br>

@if(count($reviewSearch)>0)
<h3 id="reviewresults">Review result(s):</h3>
<h6><u>Ordered by recently updated:</u></h6>

@foreach ($reviewSearch as $result)
<div class="alert alert-info" role="alert">
<p>{{\Carbon\Carbon::parse($result->created_at)->format('d/m/Y')}} - <a id="hyperlink" href="{{url('details/'.$result->id)}}">{{$result->review_title}}</a></p>
<p>Review by: {{$result->review_by}}</p>
<p>Game reviewed: {{$result->game_title}}</p>
</div>
@endforeach
{{ $reviewSearch->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
@else
    <p>No game reviews found from your search. Please refine your search and try again.</p>
@endif
@endif
<br>
<br>
@endsection