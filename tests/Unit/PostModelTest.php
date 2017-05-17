<?php

use App\Post;

class PostModelTest extends TestCase
{
	function test_adding_a_title_generates_a_slug()
	{
		$post = factory(Post::class)->make([
			'title' => 'Como instalar Laravel'
		]);

		$this->assertSame('como-instalar-laravel', $post->slug);
	}

	function test_editing_the_title_changes_the_slug()
	{
		$post = factory(Post::class)->make([
			'title' => 'Como instalar Laravel'
		]);

		$post->title = 'Como instalar laravelsito';

		$this->assertSame('como-instalar-laravelsito', $post->slug);
	}
}
