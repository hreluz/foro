<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Comment;

class CommentPolicy
{
    use HandlesAuthorization;

    public function acceptAnswer(User $user, Comment $comment)
    {
        return $user->owns($comment->post);
    }
}
