<?php

use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\PostCommented;
use App\Comment;
use App\Post;
use App\User;

class PostCommentedTest extends TestCase
{
	function test_it_builds_a_mail_message()
	{
		$user_name = 'Hector Lavoe';
		$post_title = 'Titulo del post';

		$post = new Post(['title' => $post_title ]);
		$author = new User(['name' => $user_name ]);

		$comment = new Comment;
		$comment->post = $post;
		$comment->user = $author;

		$suscriber = new User;

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
