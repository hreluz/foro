<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SubscriptionsController extends Controller
{
	public function suscribe(Post $post)
	{
		auth()->user()->suscribeTo($post);
		return redirect($post->url);
	}

	public function unsuscribe(Post $post)
	{
		auth()->user()->unsuscribeFrom($post);
		return redirect($post->url);
	}
}
