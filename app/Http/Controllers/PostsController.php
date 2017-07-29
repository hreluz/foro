<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostsController extends Controller
{
	public function index(Category $category = null , Request $request)
	{
		$posts = Post::orderBy('created_at','DESC')
			->scopes($this->getListScopes($category, $request))
			->paginate();

		$categoryItems = $this->getCategoryItems();
		return view('posts.index', compact('posts','categoryItems','category'));
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

	protected function getCategoryItems()
	{
		return Category::orderBy('name')->get()->map(function($category){
			return [
				'title' => $category->name,
				'full_url' => route('posts.index', $category)
			];
		})->toArray();
	}

	protected function getListScopes(Category $category, Request $request)
	{
		$scopes  = [];

		$routeName = $request->route()->getName();

		if($category->exists)
			$scopes['category'] = [$category];

		if($routeName == 'posts.pending')
			$scopes[] = 'pending';

		elseif($routeName == 'posts.completed')
			$scopes[] = 'completed';

		return $scopes;
	}
}
