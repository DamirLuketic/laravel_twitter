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

use App\User;
use App\Follow;

//Route::get('/', function () {
//    return view('welcome');
//});

// auth - routes

Route::auth();

// basic routes -> without middleware

Route::get('/', 'PostController@index');


// route with middleware

Route::group(['middleware' => 'auth'], function(){

Route::resource('/users', 'UserController');

Route::resource('/posts', 'PostController');

Route::resource('/follows', 'FollowController');

Route::get('/my_posts', ['as' => 'my_posts', 'uses' => 'UserController@my_posts']);

Route::get('/follows_posts', ['as' => 'follows_posts', 'uses' => 'UserController@follows_posts']);

Route::get('/search_user', ['as' => 'search_user', 'uses' => 'UserController@search_user']);


    Route::get('/mail', ['as' => 'mail', 'uses' => 'MailController@create']);

    Route::post('/send', ['as' => 'send', 'uses' => 'MailController@send']);

});


Route::group(['middleware' => ['auth', 'admin']], function()
{

Route::resource('/admin/users', 'AdminUserController');

Route::resource('/admin/posts', 'AdminPostController');


Route::post('/post/approved', 'AdminPostController@approved');

});
