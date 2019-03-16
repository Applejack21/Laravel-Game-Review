<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function() {
    
Route::get('/', 'ReviewController@index');

Route::get('homepage', 'ReviewController@index');
    
Route::get('searchdetails', 'ReviewController@searchBar');
    
Route::get('youraccount', 'ReviewController@yourAccount');
    
Route::get('reviewsjson', 'ReviewController@userChartData');
    
Route::get('commentsjson', 'ReviewController@userChartDataComments');
        
Route::post('deletecomment', 'ReviewController@deleteYourComments');

Route::get('reviewlist', 'ReviewController@reviewList');

Route::get('details/{reviewid}', 'ReviewController@details');
    
Route::post('updatereview', 'ReviewController@updateReview');
    
Route::post('addcomment', 'ReviewController@addComment');

Route::get('addreviewform', 'ReviewController@addForm');

Route::post('addreview', 'ReviewController@addReview');

Route::get('deletereviewform', 'ReviewController@deleteForm')->middleware('can:admin,App\Reviews');

Route::post('deletereviews', 'ReviewController@deleteReviews');  
});

Route::get('login', 'LoginController@loginForm');

Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@login']);

Route::get('logout', 'LoginController@logout');

Route::get('register', 'LoginController@registerForm');

Route::post('register', 'LoginController@register');
