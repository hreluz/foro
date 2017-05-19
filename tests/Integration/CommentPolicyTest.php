<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Comment;
use App\User;
use App\Policies\CommentPolicy;

class CommentPolicyTest extends TestCase
{
	use DatabaseTransactions;

	function test_the_posts_author_can_select_an_answer()
	{
		$comment = factory(Comment::class)->create();

		$policy =  new CommentPolicy;

		$this->assertTrue(
				$policy->acceptAnswer($comment->post->user, $comment)
			);
	}

	function test_non_authors_cannot_select_an_answer()
	{
		$comment = factory(Comment::class)->create();

		$policy =  new CommentPolicy;

		$this->assertFalse(
				$policy->acceptAnswer(factory(User::class)->create(), $comment)
			);
	}

}
