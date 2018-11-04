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



Route::get('/', 'ReviewController@index');

Route::get('homepage', 'ReviewController@index');

Route::get('reviewlist', 'ReviewController@reviewList');

Route::get('details/{reviewid}', 'ReviewController@details');

Route::get('addreviewform', 'ReviewController@addForm');

Route::post('addreview', 'ReviewController@addReview');

Route::get('deletereviewform', 'ReviewController@deleteForm');

Route::post('deletereviews', 'ReviewController@deleteReviews');
