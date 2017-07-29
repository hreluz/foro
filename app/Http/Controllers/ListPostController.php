<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class ListPostController extends Controller
{
	public function __invoke(Category $category = null , Request $request)
	{	
        list($orderColumn, $orderDirection) = $this->getListOrder($request->get('orden'));
        
		$posts = Post::scopes($this->getListScopes($category, $request))
			->orderBy($orderColumn, $orderDirection)
			->paginate()
			->appends(request()->intersect(['orden']));

		return view('posts.index', compact('posts','category'));
	}

	protected function getListScopes(Category $category, Request $request)
	{
		$scopes  = [];
        $routeName = $request->route()->getName();

		if($category->exists)
			$scopes['category'] = [$category];

		if($routeName == 'posts.mine')
			$scopes['byUser'] = [$request->user()];

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
