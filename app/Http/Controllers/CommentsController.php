<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
	public function store(Request $request, Post $post)
	{
		$this->validate($request,[
			'comment' => 'required'
		]);

		auth()->user()->comment($post, $request->get('comment'));
		return redirect($post->url);
	}

	public function accept(Comment $comment)
	{
		$comment->markAsAnswer();

		return redirect($comment->post->url);
	}
}
