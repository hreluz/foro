<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostsController extends Controller
{
	public function index(Category $category = null , Request $request)
	{		
        $routeName = $request->route()->getName();

        list($orderColumn, $orderDirection) = $this->getListOrder($request->get('orden'));
        
		$posts = Post::scopes($this->getListScopes($category, $routeName))
			->orderBy($orderColumn, $orderDirection)
			->paginate();

		$posts->appends(request()->intersect(['orden']));

		$categoryItems = $this->getCategoryItems($routeName);
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

	protected function getCategoryItems(string $routeName)
	{
		return Category::orderBy('name')->get()->map(function($category) use ($routeName){
			return [
				'title' => $category->name,
				'full_url' => route($routeName, $category)
			];
		})->toArray();
	}

	protected function getListScopes(Category $category, string $routeName)
	{
		$scopes  = [];

		if($category->exists)
			$scopes['category'] = [$category];

		if($routeName == 'posts.pending')
			$scopes[] = 'pending';

		elseif($routeName == 'posts.completed')
			$scopes[] = 'completed';

		return $scopes;
	}

	protected function getListOrder($order)
	{
		if($order  == 'recientes')
			return ['created_at', 'DESC'];

		if($order == 'antiguos')
			return ['created_at', 'ASC'];

		return ['created_at', 'DESC'];
	}
}
