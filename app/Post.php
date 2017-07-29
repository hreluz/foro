<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{

	use CanBeVoted;

	protected $fillable = ['content', 'title','category_id'];
	protected $casts = [
		'pending' => 'boolean',
		'score' => 'integer'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function subscriptions()
	{
		return $this->belongsToMany(User::class,'subscriptions');
	}

	public function latestComments()
	{
		return $this->comments()->orderBy('created_at', 'DESC');
	}

	public function scopeCategory($query, Category $category)
	{
		if($category->exists)
			$query->where('category_id', $category->id);

		return $query;
	}

	public function scopePending($query)
	{
		$query->where('pending', true);
	}

	public function scopeCompleted($query)
	{
		$query->where('pending', false);
	}

	public function scopeByUser($query, User $user)
	{
		$query->where('user_id', $user->id);
	}

	public function subscribers()
	{
		return $this->belongsToMany(User::class, 'subscriptions');
	}

	public function setTitleAttribute($value)
	{
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
	}

	public function getUrlAttribute()
	{
		return route('posts.show', [$this->id, $this->slug] );
	}

	public function getSafeHtmlContentAttribute()
	{
		return Markdown::convertToHtml( e($this->content));
	}

}
