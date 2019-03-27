@extends('layouts.master')
@section('title', 'Review - Your Account')
@section('content')

    <h1>Your Account</h1>
<p>This page allows you to see your interactions. As well as allowing you to delete interactions.</p>
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
<a id="hyperlink" href="{{url('details/'.$comments->review_id).'#reviewcomment'}}">
<div class="alert alert-info" role="alert">
<p>{{\Carbon\Carbon::parse($comments->created_at)->format('d/m/Y')}} - {!! nl2br(e($comments->comment)) !!}</p>
</div>
</a>
@endforeach
    {{ $findComments->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
@else
    <p>You have made 0 comments, you can make one by viewing different reviews on the website <a id="hyperlink" href="{{url('reviewlist')}}">here</a>.</p>
@endif
</div>
</div>
<br>

<h4 id="usergraphsheading">Contributions In Graphs:</h4>
<p>Below is a summary of your reviews (by rating) and the amount of comments you've made this week</p>
<div id="accordion2">
    <h3>Your Reviews:</h3>
<div id="reviewsChart">
    <canvas id="userReviewChart" style="height:40vh; width:80vw"></canvas>
</div>
    <h3>Your Comments:</h3>
<div id="commentsChart">
    <canvas id="userCommentChart" style="height:40vh; width:80vw"></canvas>
</div>
</div>

<h2 id="userdeleteitems">Delete Items:</h2>
<br>
<div id="accordion3">
    <h3>Delete Reviews</h3>
<div>
@if(count($findReviews)>0)
<h6><u>Ordered by most recent review first:</u></h6>

<form action="{{url('deletereviews')}}" method="POST">
    {{ csrf_field() }}
    @foreach ($findReviews as $reviews)
        <div class="alert alert-info" role="alert" style="width:500px">
            <p>{{$reviews->review_title}}</p>
            <input type="checkbox" value="{{$reviews->id}}" name="reviews[]" id="reviews"/>
        </div>
    @endforeach
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Delete selected reviews">
</form>
{{ $findReviews->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
@else
    <p>You have made 0 reviews, you can make one <a id="hyperlink" href="{{url('addreviewform')}}">here</a>.</p>
@endif
</div>
    
    <h3>Delete Comments</h3>      
<div>
@if(count($findComments)>0)
<h6><u>Ordered by most recent comment first:</u></h6>  
    
<form action="{{url('deletecomment')}}" method="POST">
    {{ csrf_field() }}
    @foreach ($findComments as $comments)
        <div class="alert alert-info" role="alert" style="width:500px">
            <p>{!! nl2br(e($comments->comment)) !!}</p>
            <p>Link to review: <a id="hyperlink" href="{{url('details/'.$comments->review_id).'#reviewcomment'}}">here</a></p>
            <input type="checkbox" value="{{$comments->id}}" name="comments[]" id="comments"/>
        </div>
    @endforeach
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Delete selected comments">
</form>
{{ $findComments->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
@else
    <p>You have made 0 comments, you can make one by viewing different reviews on the website <a id="hyperlink" href="{{url('reviewlist')}}">here</a>.</p>
@endif
</div>
</div>
<br>
<br>


<script>
$("#accordion").accordion({ header: "h3", collapsible: true, active: false });
    
    (function($) {
        $(function() {
            $("#accordion > div").accordion({ header: "h3", collapsible: true });
        })
    })(jQuery);
    
$("#accordion2").accordion({ header: "h3", active: false, collapsible: true }); 
$("#accordion3").accordion({ header: "h3", active: false, collapsible: true });
</script>
<script src="{{asset('js/userCharts.js')}}"></script>
<script src="{{asset('js/userChartsComments.js')}}"></script>
@endsection