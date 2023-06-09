<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::get('/register', function() {
    return redirect('/login');
});

Route::controllers(['admin' => 'AdminController']);
Route::post('/feedback', 'StaticController@feedback');
Route::get('/search/{slug?}', 'SearchController@result');
Route::get('/all-truth-about', 'StaticController@truth');
Route::get('/articles/{slug}', 'StaticController@articles');
Route::get('/policy', 'StaticController@policy');
Route::get('/{slug?}/{sub_slug?}/{sub_sub_slug?}', 'StaticController@chapter');
