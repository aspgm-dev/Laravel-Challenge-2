<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('news', 'Api\NewsController@index');
Route::get('news/show/{id}', 'Api\NewsController@show');

Route::get('comment/{id}', 'Api\CommentController@get_comment');
Route::post('comment', 'Api\CommentController@post_comment');
Route::get('comment_count/{id}', 'Api\CommentController@count_comment');
