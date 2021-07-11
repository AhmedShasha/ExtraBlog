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


Route::get('','PostsController@index');
Route::get('/posts','PostsController@index')->name('posts');
Route::post('/posts','PostsController@store')->name('posts.store');
Route::get('/posts/create','PostsController@create')->name('posts.create');
Route::get('/posts/{id}', 'PostsController@show')->name('posts.show');
Route::get('/posts/{id}/edit', 'PostsController@edit')->name('posts.edit');
Route::put('/posts/{id}', 'PostsController@update')->name('posts.update');
Route::DELETE('/posts/{id}', 'PostsController@destroy')->name('posts.destroy');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
