<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\VoteRepository;

class VoteCommentController extends Controller
{

	public function upvote(Comment $comment)
	{
		$comment->upvote($comment);

		return [
			'new_score' => $comment->score
		];
	}

	public function downvote(Comment $comment)
	{
		$comment->downvote($comment);

		return [
			'new_score' => $comment->score
		];
	}

	public function undoVote(Comment $comment)
	{
		$comment->undoVote($comment);

		return [
			'new_score' => $comment->score
		];
	}
}
