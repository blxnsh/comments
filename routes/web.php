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

Route::get('/', 'CommentController@home');
Route::get('/api/getcomments', 'CommentController@getComments');
Route::post('/api/postcomment', 'CommentController@postComment');
Route::delete('/api/deletecomment', 'CommentController@deleteComment');
Route::put('/api/updatecomment', 'CommentController@updateComment');
