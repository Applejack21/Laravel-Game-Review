@extends('layouts.master')
@section('title', 'Review - Your Account')
@section('content')

    <h1>Your Account</h1>
<p>This page shows your different interactions with the system itself, as well as change inforation about your account.</p>
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

<h2 id="usercontributions">Your Contributions:</h2>
<br>

<div id="accordion">
    <h3>Your Reviews</h3>
    <div>
@if(count($findReviews)>0)
<h6><u>Ordered by most recent review first:</u></h6>

@foreach ($findReviews as $reviews)
<a id="hyperlink" href="{{url('details/'.$reviews->id)}}">
<div class="alert alert-info" role="alert">
<p>{{\Carbon\Carbon::parse($reviews->created_at)->format('d/m/Y')}} - {{$reviews->review_title}}</p>
</div>
</a>
@endforeach
{{ $findReviews->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
@else
    <p>You have made 0 reviews, you can make one <a id="hyperlink" href="{{url('addreviewform')}}">here</a>.</p>
@endif
</div>
    <h3>Your Comments</h3>
<div>
@if(count($findComments)>0)
<h6><u>Ordered by most recent comment first:</u></h6>

@foreach($findComments as $comments)
<div class="alert alert-info" role="alert">
<p>{{\Carbon\Carbon::parse($comments->created_at)->format('d/m/Y')}} - {!! nl2br(e($comments->comment)) !!}</p>
<p>Review link: <a id="hyperlink" href="{{url('details/'.$comments->review_id).'#commentbox'}}">here</a></p>
</div>
@endforeach
    {{ $findComments->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
@else
    <p>You have made 0 comments, you can make one by viewing different reviews on the website <a id="hyperlink" href="{{url('reviewlist')}}">here</a>.</p>
@endif
</div>
</div>
<br>
<script>
$("#accordion").accordion({ header: "h3", collapsible: true, active: false });
    
    (function($) {
        $(function() {
            $("#accordion > div").accordion({ header: "h3", collapsible: true });
        })
    })(jQuery);
</script>

@endsection