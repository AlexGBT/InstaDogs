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

Route::get('/','UserController@index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::post('follow/{user}', 'FollowsController@store');
Route::get('follow/followers/{id}', 'FollowsController@showFollowers')->name('follow.show.followers');
Route::get('follow/following/{id}', 'FollowsController@showFollowing')->name('follow.show.following');


Route::resource('/profile', 'ProfileController');
Route::resource('/post','PostController');

Route::post('/comment/load','CommentController@load');
Route::resource('/comment','CommentController');

Route::post('user/search/{namePart}','UserController@search');
