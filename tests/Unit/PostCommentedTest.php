<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\PostCommented;
use App\Comment;
use App\Post;
use App\User;

class PostCommentedTest extends TestCase
{
	use DatabaseTransactions;

	function test_it_builds_a_mail_message()
	{
		$user_name = 'Hector Lavoe';
		$post_title = 'Titulo del post';

		$comment = factory(Comment::class)->create([
			'post_id' => factory(Post::class)->create(['title' => $post_title ])->id ,
			'user_id' => factory(User::class)->create(['name' => $user_name ])->id
		]);

		$suscriber = factory(User::class)->create();

		$notification = new PostCommented($comment);

		$message = $notification->toMail($suscriber);

		$subject = 'Nuevo comentario en: Titulo del post';
		$content = 'Hector Lavoe escribió un comentario en: Titulo del post';

		$this->assertInstanceOf(MailMessage::class, $message);

		$this->assertSame($subject, $message->subject);

		$this->assertSame($content,$message->introLines[0]);

		$this->assertSame($comment->post->url, $message->actionUrl);
	}
}
