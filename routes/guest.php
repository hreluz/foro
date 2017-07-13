<?php

Route::get('register',[
	'uses' => 'RegisterController@create',
	'as' => 'register'
]);

Route::post('register',[
	'uses' => 'RegisterController@store',
	'as' => 'register'
]);

Route::get('register/confirmation',[
	'uses' => 'RegisterController@confirm',
	'as' => 'register_confirmation'
]);

Route::get('token',[
	'uses' => 'TokenController@create',
	'as' => 'token'
]);

Route::post('token',[
	'uses' => 'TokenController@store',
	'as' => 'token'
]);

Route::get('login/{token}',[
	'uses' => 'LoginController@login',
	'as' => 'login'
]);