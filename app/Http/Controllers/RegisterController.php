<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Token;

class RegisterController extends Controller
{
	public function create()
	{
		return view('register.create');
	}

	public function store(Request $request)
	{
		$this->validate($request,[
			'username' => 'required',
			'email' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
		]);

		$user = User::create($request->all());
		Token::generateFor($user)->sendByEmail();

		return redirect()->route('register_confirmation');
	}

	public function register_confirmation()
	{
		return view('register.register_confirmation');
	}
}
