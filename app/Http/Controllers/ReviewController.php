<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reviews;
use App\Comments;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Http\Requests;

class ReviewController extends Controller
{
    function index()
    {
        return view('review/homepage');
    }
    
    function reviewList()
    {
        $reviews = Reviews::all();
        return view('review/reviewlist', ['reviews' => $reviews]);
    }
    
    function details($reviewId)
    {
        $reviews = Reviews::find($reviewId);
                    
        $comments = DB::table('comments')
                    ->select('comment', 'user_username', 'created_at')
                    ->Where('review_id', '=', $reviewId)
                    ->orderByDesc("created_at")
                    ->paginate(5);
        
        return view('review/details', compact('reviews', 'comments'));
    }
    
    
    function addComment(Request $request)
    {    
        $this->validate($request, [
            'commentuser' => 'max:10',
            'comment' => 'required|max:300',
        ],
        [
            'commentuser.required' => 'Username: Make sure you\'ve entered your username.',
            'commentuser.max' => 'Username: The maximum length your username can be is 10 characters.',
            
            'comment.required' => 'Comment: Make sure you\'ve entered your comment.',
            'comment.max' => 'Comment: The maximum length your comment can be is 300 characters long.'
        ]
        );
        
        $comment = new Comments();
        $comment->comment = $request->comment;
        $comment->user_username	= $request->username;
        $comment->review_id = $request->reviewid;
        $comment->save();        
        return redirect()->back(); 
    }
    
    function addForm()
    {
        return view('review/addreview');
    }
    
    function addReview(Request $request)
    {
        $this->validate($request, [
            'review_title' => 'required|max:50',
            'review_by' => 'required|max:100',
            'game_title' => 'required|max:100',
            'review_desc' => 'required|max:5000',
            'review_rating' => 'required|max:5',
        ],
        [
        'review_title.required' => 'Review title: Make sure you\'ve filled out the review title field.',
        'review_title.max' => 'Review Title: The maximum length the title can be is 50 characters.',
        
        'review_by.required' => 'Reviewed by: Make sure you\'ve filled out the reviewed by field.',
        'review_by.max' => 'Reviewed By: The maximum length the reviewed by can be is 100 characters.',
            
        'game_title.required' => 'Game title: Make sure you\'ve filled out the game title field.',
        'game_title.max' => 'Game title: The maximum length the game title can be is 100 characters.',
            
        'review_desc.required' => 'Review description: Make sure you\'ve filled out the review description field.',
        'review_desc.max' => 'Review description: The maximum length the review description can be is 5000 characters.',
        
        'review_rating.required' => 'Review rating: Make sure you\'ve selected a rating for the game.',
        'review_rating.max' => 'Review rating: The maximum rating you can give a game is 5/5',
        ]
        );
        
        $review = new Reviews();
        $review->review_title = $request->review_title;
        $review->review_by = $request->review_by;
        $review->game_title = $request->game_title;
        $review->review_desc = $request->review_desc;
        $review->review_rating = $request->review_rating;
        $review->save();
        return redirect()->back(); 
    }
    
    function deleteForm()
    {
        $reviews = Reviews::all();
        return view('review/deletereviews',['reviews' => $reviews]);
    }
    
    function deleteReviews(Request $request)
    {
        Reviews::destroy($request->reviews);
        return redirect()->back(); 
    }
    
    function __construct()
    {
        $this->middleware('auth');
    }
}
