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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/topics', 'TopicController', ['names'=>[
    'index' => 'index_topic',
    'create' => 'create_topic',
    'show' => 'show_topic'
]]);

Route::post('/topics/{id}/comments', 'CommentController@store')->middleware('auth');
Route::get('/topics/{id}/follow', 'FollowController@follow')->middleware('auth');