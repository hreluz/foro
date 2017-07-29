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

Route::get('posts-pending/{category?}', ['uses' => 'PostsController@index', 'as' => 'posts.pending']);
Route::get('posts-completed/{category?}', ['uses' => 'PostsController@index', 'as' => 'posts.completed']);

Route::get('/home', 'HomeController@index');

Route::get('posts/{post}-{slug}', ['uses' => 'PostsController@show', 'as' => 'posts.show' ])
			->where('post', '\d+');

Route::get('{category?}', ['uses' => 'PostsController@index', 'as' => 'posts.index' ]);