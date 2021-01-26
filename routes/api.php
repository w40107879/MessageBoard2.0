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
Route::get('/posts', 'PostController@getAllPost')->name('posts.show');
Route::get('/posts/{id}', 'PostController@findPostById')->name('posts.name');
Route::post('/posts', 'PostController@createPost')->name('posts.create');
Route::put('/posts/{id}', 'PostController@editPost')->name('posts.edit');
Route::delete('/posts/{id}', 'PostController@deletePost')->name('posts.delete');
