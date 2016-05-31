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

//Route::get('/', function () {
//    return view('welcome');
//});

// auth - routes

Route::auth();

//Route::get('/home', 'HomeController@index');

// basic routes -> without middleware

Route::get('/', 'BasicController@index');

Route::get('/posts', 'BasicController@index');

Route::resource('/', 'BasicController@index');
