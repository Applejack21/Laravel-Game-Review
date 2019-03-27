<?php

namespace App\Http\Controllers;
use App\Reviews;
use Response;
use App\Comments;
use Mail;
use View;
use App\Http\Requests;
use Auth;
use Response;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Validator;

class ReviewController extends Controller
{
    function index()
    {
        return view('review/homepage');
    }
    
    function searchBar(Request $request)
    {
        $searchTerm = $request->input('searchbar');
         
        $reviewSearch = DB::table('reviews')
                 ->where('game_title', 'like', '%'.$searchTerm.'%')
                 ->Orwhere('review_title', 'like', '%'.$searchTerm.'%')
                 ->orderByDesc('updated_at')
                 ->paginate(10);
            
        return view('review/searchdetails', compact('searchTerm', 'reviewSearch'));
    }
    
    function yourAccount()
    {
        $username = Auth::user()->username;
        
        $findReviews = DB::table('reviews')
                ->where('review_by', '=', $username)
                ->orderByDesc('created_at')
                ->paginate(5);
        
        $findComments = DB::table('comments')
                ->where('user_username', '=', $username)
                ->orderByDesc('created_at')
                ->paginate(5);
        
        return view('review/youraccount', compact('findReviews', 'findComments'));
    }
        
    function userChartData()
    {
        $username = Auth::user()->username;
        
        $result = DB::table('reviews')
                ->select('review_rating')
                ->where('review_by', '=', $username)
                ->get();

        return response()->json($result);
    }
        
    function userChartData()
    {
        $username = Auth::user()->username;
        
        $result = DB::table('reviews')
                ->select('review_rating')
                ->where('review_by', '=', $username)
                ->get();
        return response()->json($result);
    }
    
    function userChartDataComments()
    {
        $username = Auth::user()->username;
       
        $thisweek = Carbon::now();
        $lastweek = Carbon::now()->subWeek();
        $twoweeksago = Carbon::now()->subWeek(2);
                
        $result1 = DB::table('comments')
                ->select('id')
                ->where('user_username', '=', $username)
                ->where('created_at', '<=', $thisweek)
                ->where('created_at', '>=', $lastweek)
                ->get();
        
         $result2 = DB::table('comments')
                ->select('id')
                ->where('user_username', '=', $username)
                ->where('created_at', '<=', $lastweek)
                ->where('created_at', '>=', $twoweeksago)
                ->get();
        
        return Response::json($result1);
    }
        
    function deleteYourComments(Request $request)
    {
        $this->validate($request, [
            'comments' => 'required',
        ],
        [
        'comments.required' => 'Delete comment: Make sure you\'ve ticked a comment to delete first.',
        ]
        );
        Comments::destroy($request->comments);
        $request->session()->flash('alert-success', 'Deleted the selected comment(s) successfully.');
        
        return redirect()->back();
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
    
    function updateReview (Request $request)
    {
        $this->validate($request, [
            'edittitle' => 'required|max:200',
            'editreviewby' => 'required|max:100',
            'editgametitle' => 'required|max:100',
            'editdescription' => 'required|max:5000',
            'editrating' => 'required|max:5',
        ],
        [
        'edittitle.required' => 'Review title: Make sure you\'ve filled out the review title field.',
        'edittitle.max' => 'Review Title: The maximum length the title can be is 200 characters.',
        
        'editreviewby.required' => 'Reviewed by: Make sure you\'ve filled out the reviewed by field.',
        'editreviewby.max' => 'Reviewed By: The maximum length the reviewed by can be is 100 characters.',
            
        'editgametitle.required' => 'Game title: Make sure you\'ve filled out the game title field.',
        'editgametitle.max' => 'Game title: The maximum length the game title can be is 100 characters.',
            
        'editdescription.required' => 'Review description: Make sure you\'ve filled out the review description field.',
        'editdescription.max' => 'Review description: The maximum length the review description can be is 5000 characters.',
        
        'editrating.required' => 'Review rating: Make sure you\'ve selected a rating for the game.',
        'editrating.max' => 'Review rating: The maximum rating you can give a game is 5/5',
        ]
        );
        $update = Reviews::where('id', $request->editreviewid)
                    ->update([
                    'review_title' => $request->edittitle,
                    'review_by' => $request->editreviewby,
                    'game_title' => $request->editgametitle,
                    'review_desc' => $request->editdescription,
                    'review_rating' => $request->editrating,
                    ]);
        $request->session()->flash('alert-success', 'Review successfully updated.');
        return redirect()->back();
    }
    
    
    function addComment(Request $request)
    {    
        //get info from the comment form
        $reviewid = $request->reviewid;
        $usernamecomment = $request->username;
        $actualcomment = $request->comment;
        
        //find the username of the reviewer + title of the review
        $findUsername = DB::table('reviews')
                    ->select('review_by', 'review_title')
                    ->where('id', '=', $reviewid)
                    ->get();
        
        //store said username
        $storeUsername = $findUsername[0]->review_by;
        
        //find their email address and username in the users table
        $findInfo = DB::table('users')
                    ->select('username', 'email', 'first_name', 'last_name')
                    ->where('username', '=', $storeUsername)
                    ->get();
        
        //store review title, username, and their email address
        $reviewerTitle = $findUsername[0]->review_title;
        $reviewerUsername = $findInfo[0]->username;
        $reviewerEmail = $findInfo[0]->email;
        $reviewerFirstName = $findInfo[0]->first_name;
        $reviewerLastName = $findInfo[0]->last_name;
        
        //validate the actual comment that the user is submitting
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
        if ($reviewerUsername != $usernamecomment)
        {
        // Email the reviewer about the comment
        $data = array(
            'comment' => $actualcomment,
            'commenterusername' => $usernamecomment,
            'reviewid' => $reviewid,
            'reviewertitle' => $reviewerTitle,
            'reviewerUsername' => $reviewerUsername,
            'reviewerEmail' => $reviewerEmail,
            'reviewerFirstName' => $reviewerFirstName,
            'reviewerLastName' => $reviewerLastName
        );
        // Path or name to the blade template to be rendered
        $template_path = 'email.email_receivedcomment';
        
        Mail::send($template_path, $data, function($message) use($data, $actualcomment, $usernamecomment, $reviewid, $reviewerTitle, $reviewerUsername, $reviewerEmail, $reviewerFirstName, $reviewerLastName) {
            //Set the receiver and the subject of the mail.
            $message->to($reviewerEmail, $reviewerFirstName.' '.$reviewerLastName)->subject('New Comment - Review System');
            //Set the sender
            $message->from('reviewsystem@noreply', 'Review System');
        });
        }
        
        //store comment into database, and redirect back to the review with an alert
        $comment = new Comments();
        $comment->comment = $actualcomment;
        $comment->user_username	= $usernamecomment;
        $comment->review_id = $reviewid;
        $comment->save();  
        $request->session()->flash('alert-success', 'Comment added successfully.');
        return redirect()->back(); 
    }
    
    function addForm()
    {
        return view('review/addreview');
    }
    
    function addReview(Request $request)
    {
        $this->validate($request, [
            'review_title' => 'required|max:200',
            'review_by' => 'required|max:100',
            'game_title' => 'required|max:100',
            'review_desc' => 'required|max:5000',
            'review_rating' => 'required|max:5',
        ],
        [
        'review_title.required' => 'Review title: Make sure you\'ve filled out the review title field.',
        'review_title.max' => 'Review Title: The maximum length the title can be is 200 characters.',
        
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
        $request->session()->flash('alert-success', 'Review added successfully. You can view it by going to Reviews -> View Reviews');
        return redirect()->back(); 
    }
    
    function deleteForm()
    {
        $reviews = Reviews::all();
        return view('review/deletereviews',['reviews' => $reviews]);
    }

    function deleteReviews(Request $request)
    {
        $reviewid = $request->reviews;
       
        $this->validate($request, [
            'reviews' => 'required',
        ],
        [
        'reviews.required' => 'Delete review: Make sure you\'ve ticked a review to delete first.',
        ]
        );
        Reviews::destroy($reviewid);
        Comments::where('review_id', '=', $reviewid)->delete();
        $request->session()->flash('alert-success', 'Deleted the selected review(s) successfully.');
        return redirect()->back(); 
    }
    
    function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
}
