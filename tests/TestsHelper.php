<?php

namespace Tests;
use App\User;
use App\Post;

trait TestsHelper
{
    protected $defaultUser;

    public function defaultUser(array $attributes = [])
    {
        if($this->defaultUser)
            return $this->defaultUser;

        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function createPost(array $attributes = [])
    {
        return factory(Post::class)->create($attributes);   
    }
    
    protected function anyone(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }    
}