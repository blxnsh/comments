<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getcomments', 'CommentController@getComments');
Route::post('/postcomment', 'CommentController@postComment');
Route::delete('/deletecomment', 'CommentController@deleteComment');
Route::put('/updatecomment', 'CommentController@updateComment');
