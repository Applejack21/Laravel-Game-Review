@extends('layouts.master')
@section('title', 'Reviews - View Review')
@section('content')

@if (count($errors) > 0)
    <br>
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
</div>

<div id="reviewinfo">
<h1 id="reviewheader">{{$reviews->review_title}}</h1>
<ul>
<li>Reviewed On: {{\Carbon\Carbon::parse($reviews->created_at)->format('d/m/Y - H:i')}}</li>
<br>

<li>Updated On: {{\Carbon\Carbon::parse($reviews->updated_at)->format('d/m/Y - H:i')}}</li>
<br>

<li>Reviewed By: {{$reviews->review_by}}</li>
<br>
    
<li>Game Reviewed: {{$reviews->game_title}}</li>
<br>
    
<li>Overall Rating: {{$reviews->review_rating}} out of 5</li>
<br>
</ul>
</div>

<div id="reviewtext">
<h2 id="reviewtexthead">Review Text:</h2>
<ul>
<li id="reviewtext">
{!! nl2br(e($reviews->review_desc)) !!}
</li>
</ul>
</div>

@if (Auth::user()->username == $reviews->review_by)
<div id="reviewedit">
<h2 id="reviewedithead">Edit Review:</h2>
<p>Click the button below to edit your review:</p>
<button id="showeditreview" class="btn btn-outline-warning cleardate" onclick="openForm('editreview')">Edit Review</button>

<div id="editreview" class="form" style="display:none;">
<form action="{{url('updatereview')}}" method="POST">
{{ csrf_field() }}
<br>
<input type="hidden" name="editreviewid" id="editreviewid" value="{{$reviews->id}}"> 
<input type="hidden" name="editreviewby" id="editreviewby" value="{{Auth::user()->username}}" readonly>
    
<label for="edittitle">Edit review title:</label>
<input type="text" name="edittitle" id="edittitle" value="{{$reviews->review_title}}">
<br>
    
<label for="editgametitle">Edit game title:</label>
<input type="text" name="editgametitle" id="editgametitle" value="{{$reviews->game_title}}">
<br>
    
<label for="editdescription">Edit review description:</label>
<textarea id="editdescription" name="editdescription" maxlength="5000">{{$reviews->review_desc}}</textarea>
<div id="the-count" style="padding-left:270px">
    <span>Character length:</span>
    <span id="current">0</span>
    <span id="maximum">/ 5000</span>
</div>
<script>
$('#editdescription').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');
    
  current.text(characterCount);
     
}); 
</script>
<br>
    
<label for="editrating">Edit your rating:</label>
<select id="editrating" name="editrating">
    <option selected disabled>Select your new rating...</option>
    <option id="0" value="0">0/5</option>
    <option id="1" value="1">1/5</option>
    <option id="2" value="2">2/5</option>
    <option id="3" value="3">3/5</option>
    <option id="4" value="4">4/5</option>
    <option id="5" value="5">5/5</option>
</select>
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Update Review" style="margin-left:50px; margin-top:10px;">
</form>
</div>
<br>    
<br>    
</div>
@endif

<div id="reviewcomment">
<h2 id="reviewcommentshead">Comments:</h2>
<u><p>Sorted by recent first:</p></u>
@foreach ($comments as $comment)
<div id="comments" class="alert alert-info" role="alert" style="height: auto;">
<p>{{$comment->user_username}} - {{\Carbon\Carbon::parse($comment->created_at)->format('d/m/Y - H:i')}}</p>
<p>{!! nl2br(e($comment->comment)) !!}</p>
<br>
</div>
@endforeach
<p><u>Change Page:</u></p>
        {{ $comments->appends(Request::except('page'))->links('vendor.pagination.bootstrap-4') }}

<div id="commentbox">
<h2 id="reviewaddcomment">Add a comment:</h2>
<br>
@if (Auth::check())
<form action="{{url('addcomment')}}" method="POST">
{{ csrf_field() }}
<input type="hidden" name="reviewid" id="reviewid" value="{{$reviews->id}}">
<label for="username">Username:</label>
<input type="text" name="username" id="username" value="{{Auth::user()->username}}" readonly>
<br>
<label for="comment">Comment:</label>
<textarea name="comment" id="comment" maxlength="300" placeholder="Enter your comment..."></textarea>
<div id="the-count" style="padding-left:280px">
    <span>Character length:</span>
    <span id="current">0</span>
    <span id="maximum">/ 300</span>
</div>
<script>
$('#comment').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');
    
  current.text(characterCount);
     
}); 
//scripts to display the relevant divs
function openForm(formName) {
    var i;
    var x = document.getElementsByClassName("form");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(formName).style.display = "block";
};
</script>
<br>
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Add comment">
</form>
@else
<p>Please <a href="{{url('login')}}">Login</a> to leave a comment</p>
</div> 
</div>

@endif
@endsection