<?php

use App\Mail\TokenMail;
use App\User;
use App\Token;
use Illuminate\Mail\Mailable;
use \Symfony\Component\DomCrawler\Crawler;

class TokenMailTest extends FeatureTestCase
{
	function test_it_sends_a_link_with_the_token()
	{
		$user = new User([
			'first_name' => 'Hector',
			'last_name' => 'Lavoe',
			'email' => 'hlavoe@lavoe.com'
		]);

		$token = new Token([
			'token' => 'this-is-a-token',
			'user_id' => $user
		]);
		
		$this->open( new TokenMail($token)  )
			->seeLink($token->url, $token->url);
	}


	//InteractsWithMailable
	protected function open(Mailable $mailable)
	{
		$transport = Mail::getSwiftMailer()->getTransport();
		$transport->flush();

		Mail::send($mailable);

		$message = $transport->messages()->first();

		$this->crawler = new Crawler($message->getBody());

		return $this;
	}
}
