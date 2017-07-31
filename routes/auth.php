<?php

Route::post('logout', function(){
	auth()->logout();
	return redirect('/');
});

//Posts
Route::get('posts/create', ['uses' => 'CreatePostController@create', 'as' => 'posts.create' ]);
Route::post('posts', ['uses' => 'CreatePostController@store', 'as' => 'posts.store' ]);

//Votes

Route::pattern('module', '[a-z]+');

Route::bind('votable', function($votableId, $route){

	$modules = [
		'posts' => \App\Post::class,
		'comments' => \App\Comment::class,
	];

	$model = $modules[ $route->parameter('module') ] ?? null;

	abort_unless($model, 404);

	return $model::findOrFail($votableId);
});

Route::post('{module}/{votable}/vote/1', ['uses' => 'VoteController@upvote', 'as' => 'votes.upvote' ]);

Route::post('{module}/{votable}/vote/-1', ['uses' => 'VoteController@downvote', 'as' => 'votes.downvote' ]);

Route::delete('{module}/{votable}/vote', ['uses' => 'VoteController@undoVote', 'as' => 'votes.undoVote' ]);

//Comments
Route::post('posts/{post}/comment', ['uses' => 'CommentsController@store', 'as' => 'comments.store' ]);
Route::post('comments/{comment}/accept', ['uses' => 'CommentsController@accept', 'as' => 'comments.accept' ]);

//Subscribe
Route::post('posts/{post}/suscribe', ['uses' => 'SubscriptionsController@suscribe', 'as' => 'posts.suscribe' ]);
Route::delete('posts/{post}/unsuscribe', ['uses' => 'SubscriptionsController@unsuscribe', 'as' => 'posts.unsuscribe' ]);

Route::get('mis-posts/{category?}',  ['uses' => 'ListPostController', 'as' => 'posts.mine']);