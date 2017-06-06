<?php

use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCommented;

class NotifyUsersTest extends FeatureTestCase
{
	function test_the_subscribers_receive_a_notification_when_post_is_commented()
	{
		Notification::fake();

		$post = $this->createPost();

		$subscriber = factory(User::class)->create();

		$subscriber->suscribeTo($post);

		$writer = factory(User::class)->create();

		$writer->suscribeTo($post);

		$comment = $writer->comment($post, 'Un comentario cualquiera');

		Notification::assertSentTo($subscriber, PostCommented::class, function($notification) use($comment) {
			return $notification->comment->id == $comment->id;

		});

		//The author of the comment shouldn't be notified even if he or she is a subscriber
		Notification::assertNotSentTo($writer, PostCommented::class);
	}
}
