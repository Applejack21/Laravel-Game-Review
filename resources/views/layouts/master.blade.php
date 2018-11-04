<html>
<head>
<title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js/extrajquery.js')}}"></script>
</head>
    
<body>
@section('header')
    <p id="headernotice"><b>NOTE: </b>It is recommended to use either: <i>Firefox</i> or <i>Chrome</i> when using this site.</p>
<ul class="nav">
    <li id="home"><a href="{{url('homepage')}}">Homepage</a></li>
    <li id="review" class="reviewdrop">
    <a href=# class="dropbtn">Reviews</a>
        <div class="review-content">
            <a href="{{url('reviewlist')}}">View Reviews</a>
            <a href="{{url('addreviewform')}}">Add Review</a>
            <a href="{{url('deletereviewform')}}">Delete Reviews</a>
        </div>
    </li>
        

</ul>
    @show
    <br>
    <br>
    
<a href="javascript:history.back()"><button id="backbutton" type="button" class="btn btn-primary previouspage" > &laquo; Previous Page</button></a>
    <br>
    <br>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>