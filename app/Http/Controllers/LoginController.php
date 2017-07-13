<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Token;

class LoginController extends Controller
{
	public function login($token)
	{
		$token = Token::findActive($token);

		if(!$token):
			alert('Este enlace ya expiró por favor solicita otro','danger');
			return redirect()->route('token');
		endif;

		$token->login();
		
		return redirect('/');
	}
}
