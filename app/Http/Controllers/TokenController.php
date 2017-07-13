<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Token;
use App\User;

class TokenController extends Controller
{
	public function create()
	{
		return view('token.create');
	}

	public function store(Request $request)
	{
		$this->validate($request,[
			'email' => 'required|email|exists:users,email',
		]);


		$user = User::where('email', $request->get('email'))->first();
		Token::generateFor($user)->sendByEmail();

		alert('Enviamos a tu email un enlace para que inicies sesión');

		return back();
	}
}
