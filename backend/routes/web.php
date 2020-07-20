<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/home');

Auth::routes(['register' => false]);

Route::group([
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth']], function () {

        Route::get('/home', 'DashboardController@index')->name('home');

        Route::resource('category', 'CategoryController');
  
        Route::resource('tag', 'TagController');
  
        Route::resource('comment', 'CommentController');
  
        Route::resource('news', 'NewsController');
        Route::post('add-comment', 'NewsController@add_comment')->name('add-comment');
    }
);