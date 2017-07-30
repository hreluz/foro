<?php

//Posts
Route::get('posts/create', ['uses' => 'CreatePostController@create', 'as' => 'posts.create' ]);
Route::post('posts', ['uses' => 'CreatePostController@store', 'as' => 'posts.store' ]);

//Votes
Route::post('posts/{post}/vote/1', ['uses' => 'VotePostController@upvote', 'as' => 'posts.upvote' ]);

Route::post('posts/{post}/vote/-1', ['uses' => 'VotePostController@downvote', 'as' => 'posts.downvote' ]);

Route::delete('posts/{post}/vote', ['uses' => 'VotePostController@undoVote', 'as' => 'posts.undoVote' ]);

//Comments
Route::post('posts/{post}/comment', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);
Route::post('comments/{comment}/accept', ['uses' => 'CommentsController@accept', 'as' => 'comments.accept' ]);

Route::post('comments/{comment}/vote/1', ['uses' => 'VoteCommentController@upvote', 'as' => 'comments.upvote' ]);

Route::post('comments/{comment}/vote/-1', ['uses' => 'VoteCommentController@downvote', 'as' => 'comments.downvote' ]);

Route::delete('comments/{comment}/vote', ['uses' => 'VoteCommentController@undoVote', 'as' => 'comments.undoVote' ]);

//Subscribe
Route::post('posts/{post}/suscribe', ['uses' => 'SubscriptionsController@suscribe', 'as' => 'posts.suscribe' ]);
Route::delete('posts/{post}/unsuscribe', ['uses' => 'SubscriptionsController@unsuscribe', 'as' => 'posts.unsuscribe' ]);

Route::get('mis-posts/{category?}',  ['uses' => 'ListPostController', 'as' => 'posts.mine']);