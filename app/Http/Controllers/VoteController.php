<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{

	public function upvote($module, $votable)
	{
		$votable->upvote($votable);

		return [
			'new_score' => $votable->score
		];
	}

	public function downvote($module, $votable)
	{
		$votable->downvote($votable);

		return [
			'new_score' => $votable->score
		];
	}

	public function undoVote($module, $votable)
	{
		$votable->undoVote($votable);

		return [
			'new_score' => $votable->score
		];
	}
}
