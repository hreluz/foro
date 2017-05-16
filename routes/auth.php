<?php

//Posts
Route::get('posts/create', ['uses' => 'PostsController@create', 'as' => 'posts.create' ]);
Route::post('posts', ['uses' => 'PostsController@store', 'as' => 'posts.store' ]);