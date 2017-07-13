<?php

use Illuminate\Support\Facades\Mail;
use App\Token;
use App\User;
use App\Mail\TokenMail;

class RegistrationTest extends FeatureTestCase
{
	function test_a_user_can_create_an_account()
	{
		Mail::fake();

		$email = 'admin@lavoe.com';
		$username = 'hlavoe';
		$first_name = 'Hector';
		$last_name = 'Lavoe';

		$this->visitRoute('register')
			->type($email,'email')
			->type($username,'username')
			->type($first_name,'first_name')
			->type($last_name,'last_name')
			->press('Registrate');

		$this->seeInDatabase('users',[
			'email' => $email,
			'username' => $username,
			'first_name' => $first_name,
			'last_name' => $last_name,
		]);

		$user = User::first();

		$this->seeInDatabase('tokens',[
			'user_id' => $user->id
		]);

		$token = Token::where('user_id', $user->id)->first();

		$this->assertNotNull($token);

		Mail::assertSent(TokenMail::class, function($mail) use ($token, $user){
			return $mail->hasTo($user) && $mail->token->id == $token->id;
		});

		$this->seeRouteIs('register_confirmation')
			->see('Gracias por registrarte')
			->see('Enviamos a tu email un enlace para que inicies sesión');
	}

	function test_register_user_form_validation()
	{
		$register_url = route('register');

		$this->visit($register_url)
			->press('Registrate')
			->seePageIs($register_url)
			->seeErrors([
				'username' => 'El campo usuario es obligatorio',
				'first_name' => 'El campo nombre es obligatorio',
				'last_name' => 'El campo apellido es obligatorio',
				'email' => 'El campo correo electrónico es obligatorio',
			]);

	}
}
