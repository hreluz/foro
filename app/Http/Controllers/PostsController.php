<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostsController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('created_at','DESC')->paginate();
		return view('posts.index', compact('posts'));
	}

	public function create()
	{
		$categories = Category::pluck('name','id')->toArray();
		return view('posts.create', compact('categories'));
	}

	public function store(Request $request)
	{
		$this->validate($request,[
			'title' => 'required',
			'content' => 'required',
			'category_id' => 'required|exists:categories,id'
		]);

		$post = auth()->user()->createPost($request->all());

		return redirect($post->url);
	}

	public function show(Post $post, $slug)
	{
		if($post->slug != $slug)
			return redirect($post->url, 301);

		return view('posts.show',compact('post'));
	}
}
