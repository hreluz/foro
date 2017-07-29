<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Vote, Post};

class VotePostController extends Controller
{
	public function upvote(Post $post)
	{
		Vote::upvote($post);
		
		return [
			'new_score' => $post->score
		];

	}
}
