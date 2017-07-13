<?php

use App\Post;

class PostIntegrationTest extends FeatureTestCase
{
	function test_a_slug_is_generated_and_saved_to_the_database()
    {
		$post = factory(Post::class)->create([
			'title' => 'Como instalar Laravel'
		]);

		$this->seeInDatabase('posts',[
			'slug' => 'como-instalar-laravel'
		]);

		$this->assertSame('como-instalar-laravel', $post->fresh()->slug);
    }
}
