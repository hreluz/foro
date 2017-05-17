<?php

use App\User;
use App\Post;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $defaultUser;
    
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function defaultUser(array $attributes = [])
    {
        if($this->defaultUser)
            return $this->defaultUser;

        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function defaultPost(array $attributes = [])
    {
        return factory(Post::class)->create($attributes);   
    }
}
