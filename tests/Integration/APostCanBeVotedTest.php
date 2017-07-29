<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Vote;

class APostCanBeVotedTest extends TestCase
{
 	use DatabaseTransactions;

 	function test_a_post_can_be_upvoted()
 	{
 		$post = $this->createPost();

 		$this->actingAs($user = $this->defaultUser());

 		Vote::upvote($post);

 		$this->assertDatabaseHas('votes', [
 			'post_id' => $post->id,
 			'user_id' => $user->id,
 			'vote' => 1
 		]);

 		$this->assertSame(1, $post->score);
 	}
}