<?php

//Posts
Route::get('posts/create', ['uses' => 'PostsController@create', 'as' => 'posts.create' ]);
Route::post('posts', ['uses' => 'PostsController@store', 'as' => 'posts.store' ]);

//Comments
Route::post('posts/{post}/comment', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);