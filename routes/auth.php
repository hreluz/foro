<?php

//Posts
Route::get('posts/create', ['uses' => 'CreatePostController@create', 'as' => 'posts.create' ]);
Route::post('posts', ['uses' => 'CreatePostController@store', 'as' => 'posts.store' ]);

//Comments
Route::post('posts/{post}/comment', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);
Route::post('comments/{comment}/accept', ['uses' => 'CommentsController@accept', 'as' => 'comments.accept' ]);

//Subscribe
Route::post('posts/{post}/suscribe', ['uses' => 'SubscriptionsController@suscribe', 'as' => 'posts.suscribe' ]);
Route::delete('posts/{post}/unsuscribe', ['uses' => 'SubscriptionsController@unsuscribe', 'as' => 'posts.unsuscribe' ]);

Route::get('mis-posts/{category?}',  ['uses' => 'ListPostController', 'as' => 'posts.mine']);