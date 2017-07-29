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
        
		$posts = Post::query()
			->with(['user','category'])
			->category($category)
			->scopes($this->getRouteScope($request))
			->orderBy($orderColumn, $orderDirection)
			->paginate()
			->appends(request()->intersect(['orden']));

		return view('posts.index', compact('posts','category'));
	}

	protected function getRouteScope(Request $request)
	{
		$scopes = [
			'posts.mine' => ['byUser' => [$request->user()]],
			'posts.pending' => ['pending'],
			'posts.completed' => ['completed'],
		];

		return $scopes[ $request->route()->getName()  ] ?? [];
	}

	protected function getListOrder($order)
	{
		$orders = [
			'recientes' => ['created_at' , 'DESC'],
			'antiguos' => ['created_at' , 'ASC'],
		];

		return $orders[$order] ?? ['created_at', 'DESC'];
	}
}
