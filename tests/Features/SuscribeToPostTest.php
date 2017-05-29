<?php
use App\User;

class SuscribeToPostTest extends FeatureTestCase
{
	function test_a_user_can_suscribe_to_a_post()
	{
		$post = $this->createPost();

		$user = factory(User::class)->create();

		$this->actingAs($user);

		//When
		$this->visit($post->url)
			->press('Suscribirse al post');

		//Then
		$this->seeInDatabase('subscriptions',[
			'user_id' => $user->id,
			'post_id' => $post->id
		]);
		
		$this->seePageIs($post->url)
			->dontSee('Suscribirse al post');
	}

	function test_a_user_can_unsubscribe_from_a_post()
	{
		//Having
		$post = $this->createPost();

		$user = factory(User::class)->create();

		$this->actingAs($user);

		$user->suscribeTo($post);

		//When
		$this->visit($post->url)
			->dontSee('Suscribirse al post')
			->press('Desuscribirse del post');

		$this->dontSeeInDatabase('subscriptions',[
			'user_id' => $user->id,
			'post_id' => $post->id
		]);

		$this->seePageIs($post->url);
	}
}
