<?php

class ShowPostTest extends FeatureTestCase
{
	function test_a_user_can_see_the_post_details()
	{
		//Having
		$user = $this->defaultUser([
			'name' => 'Hector Lavoe'
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
			->see($post->user->name);
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
