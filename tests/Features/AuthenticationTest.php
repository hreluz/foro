<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\TokenMail;
use App\Token;

class AuthenticationTest extends FeatureTestCase
{
	function test_a_guest_user_can_request_a_token()
	{
		//Having
		Mail::fake();

		$user = $this->defaultUser(['email' => 'admin@lavoe.com']);

		//When
		$this->visitRoute('login')
			->type('admin@lavoe.com', 'email')
			->press('Solicitar Token');

		//Then: a new token NOT is created in the database
		$token = Token::where('user_id', $user->id)->first();

		$this->assertNotNull($token, 'A token was not created');

		//And sent to the user
		Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token){
			return $mail->token->id == $token->id;
		});

		$this->dontSeeIsAuthenticated();

		$this->see('Enviamos a tu email un enlace para que inicies sesión');
	}

	function test_a_guest_user_cannot_request_a_token_without_an_email()
	{
		//Having
		Mail::fake();

		//When
		$this->visitRoute('login')
			->press('Solicitar Token');

		$this->seeErrors([
			'email' => 'El campo correo electrónico es obligatorio'
		]);
	}

	function test_a_guest_user_cannot_request_a_token_with_an_invalid_email()
	{
		//Having
		Mail::fake();

		//When
		$this->visitRoute('login')
			->type('Lavoe','email')
			->press('Solicitar Token');

		$this->seeErrors([
			'email' => 'correo electrónico no es un correo válido'
		]);
	}

	function test_a_guest_user_cannot_request_a_token_with_a_non_existent_email()
	{
		//Having
		Mail::fake();

		$user = $this->defaultUser(['email' => 'admin@lavoe.com']);

		//When
		$this->visitRoute('login')
			->type('hectorlavoe@gmail.com','email')
			->press('Solicitar Token');

		$this->seeErrors([
			'email' => 'Este correo electrónico no existe'
		]);
	}
}
