<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Token;
use Auth;

class LoginController extends Controller
{
	public function login(Token $token)
	{
		Auth::login($token->user);

		$token->delete();
		
		return redirect('/');
	}
}
