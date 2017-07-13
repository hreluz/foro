<?php

class ShowPostTest extends FeatureTestCase
{
	function test_a_user_can_see_the_post_details()
	{
		$first_name = 'Hector';
		$last_name = 'Lavoe';

		//Having
		$user = $this->defaultUser([
			'first_name' => $first_name,
			'last_name' => $last_name
		]);

		$post = $this->createPost([
				'title' => 'Este es el titulo del post',
				'content' => 'Este es el contenido del post',
				'user_id' => $user->id
		]);

		//When
		$this->visit($post->url)
			->seeInElement('h1', $post->title)
			->see($post->content)
			->see($first_name.' '.$last_name);
	}

	function test_old_urls_are_redirected()
	{
		// Having
		$user = $this->defaultUser();

		$post =  $this->createPost([
			'title' => 'Old Title',
			'user_id' => $user->id
		]);

		$url = $post->url;

		$post->update(['title' => 'New Title']);

		$this->visit($url)
			->seePageis($post->url);
	}
}
