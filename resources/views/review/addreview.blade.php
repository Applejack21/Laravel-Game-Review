@extends('layouts.master')
@section('title', 'Add a new review')
@section('content')

<h1>Add New Review</h1>

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
</div>

<div>
<form action="{{url('addreview')}}" method="POST">
{{ csrf_field() }}
<label for="review_title">Review title:</label>
<input type="text" name="review_title" id="review_title" value="{{old('review_title')}}">
<br>

<label for="review_by">Reviewed by:</label>
<input type="text" name="review_by" id="review_by" value="{{Auth::user()->username}}" readonly>
<br>
    
<label for="game_title">Game title:</label>
<input type="text" name="game_title" id="game_title" value="{{old('game_title')}}">
<br>
    
<label for="review_desc">Review description:</label>
<textarea id="review_desc" name="review_desc" maxlength="5000" placeholder="Enter your review...">{{old('review_desc')}}</textarea>
<div id="the-count" style="padding-left:270px">
    <span>Character length:</span>
    <span id="current">0</span>
    <span id="maximum">/ 5000</span>
</div>
<script>
$('#review_desc').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');
    
  current.text(characterCount);
     
}); 
</script>
<br>
    
<label for="review_rating">Select your rating:</label>
<select id="review_rating" name="review_rating">
    <option selected disabled>Please select a rating...</option>
    <option id="0" value="0">0/5</option>
    <option id="1" value="1">1/5</option>
    <option id="2" value="2">2/5</option>
    <option id="3" value="3">3/5</option>
    <option id="4" value="4">4/5</option>
    <option id="5" value="5">5/5</option>
</select>
<br>
    
<input type="submit" class="btn btn-primary previouspage" name="submitBtn" value="Add review">
</form>
</div>
@endsection