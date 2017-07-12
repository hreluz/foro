<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCommented;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name','last_name','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Post::class,'subscriptions');
    }

    public function comment(Post $post, $message)
    {
        $comment = new Comment([
            'comment' => $message,
            'post_id' => $post->id
        ]);

        $this->comments()->save($comment);

        //Notify suscribers
        Notification::send(
            $post->subscribers()->where('users.id','!=',$this->id)->get(), 
            new PostCommented($comment)
        );

        return $comment;
    }

    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    public function isSubscribedTo(Post $post)
    {
        return $this->subscriptions()->where('post_id', $post->id)->count() > 0;
    }

    public function suscribeTo(Post $post)
    {
       return $this->subscriptions()->attach($post);
    }

    public function unsuscribeFrom(Post $post)
    {
       return $this->subscriptions()->detach($post);
    }

    public function createPost(array $data)
    {
        $post = new Post($data);
        $this->posts()->save($post);
        $this->suscribeTo($post);
        return $post;
    }
}
