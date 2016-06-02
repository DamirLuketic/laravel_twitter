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

//Route::get('/home', 'HomeController@index');

// basic routes -> without middleware

Route::get('/', 'PostController@index');

// route with middleware

Route::resource('/users', 'UserController');

Route::resource('/posts', 'PostController');

Route::resource('/follows', 'FollowController');

Route::get('/my_posts', ['as' => 'my_posts', 'uses' => 'UserController@my_posts']);

Route::get('/follows_posts', ['as' => 'follows_posts', 'uses' => 'UserController@follows_posts']);



//Route::group(['middleware' => 'auth'], function()
//{
//    Route::post('/comment/reply', 'CommentRepliesController@createReply');
//});



Route::get('/test', function() {
    $user_follows = User::find(1)->follows;

    $follows = array();

    foreach ($user_follows as $follow) {


    $follows[] = $follow->follow_id;

}

//    print_r($follows);

//    return $user_follows;

    $users = User::find($follows);

    foreach ($users as $user) {
        echo $user->nickname . '<br />';
    }

});