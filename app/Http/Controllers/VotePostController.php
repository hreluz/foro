<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\VoteRepository;

class VotePostController extends Controller
{

	public function upvote(Post $post)
	{
		$post->upvote($post);

		return [
			'new_score' => $post->score
		];
	}

	public function downvote(Post $post)
	{
		$post->downvote($post);

		return [
			'new_score' => $post->score
		];
	}

	public function undoVote(Post $post)
	{
		$post->undoVote($post);

		return [
			'new_score' => $post->score
		];
	}
}
