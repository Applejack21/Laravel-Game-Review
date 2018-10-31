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

    Route::get('all',function()
    {
        return "show all films";
    });
    Route::get('details/{filmId}',function($filmId)
    {
        return "details for film ".$filmId;
    });
    Route::get('addform',function()
    {
        return "show add film form";
    });
    Route::post('addfilm',function()
    {
        return "add a new film";
    });
    Route::get('deleteform',function()
    {
        return "show delete film form";
    });
    Route::post('deletefilms',function()
    {
        return "delete films";
    });
