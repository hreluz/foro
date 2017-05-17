<?php
use App\Post;

class ShowPostTest extends FeatureTestCase
{
	function test_a_user_can_see_the_post_details()
	{
		//Having
		$user = $this->defaultUser([
			'name' => 'Hector Lavoe'
		]);

		$post = factory(Post::class)->make([
				'title' => 'Este es el titulo del post',
				'content' => 'Este es el contenido del post'
		]);

		$user->posts()->save($post);

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

		$post = factory(Post::class)->make([
			'title' => 'Old Title'
		]);

		$user->posts()->save($post);

		$url = $post->url;

		$post->update(['title' => 'New Title']);

		$this->visit($url)
			->seePageis($post->url);
	}
}
