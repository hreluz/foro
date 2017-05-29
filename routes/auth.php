<?php

//Posts
Route::get('posts/create', ['uses' => 'PostsController@create', 'as' => 'posts.create' ]);
Route::post('posts', ['uses' => 'PostsController@store', 'as' => 'posts.store' ]);

//Comments
Route::post('posts/{post}/comment', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);
Route::post('comments/{comment}/accept', ['uses' => 'CommentsController@accept', 'as' => 'comments.accept' ]);

//Subscribe
Route::post('posts/{post}/suscribe', ['uses' => 'SubscriptionsController@suscribe', 'as' => 'posts.suscribe' ]);
Route::delete('posts/{post}/unsuscribe', ['uses' => 'SubscriptionsController@unsuscribe', 'as' => 'posts.unsuscribe' ]);
