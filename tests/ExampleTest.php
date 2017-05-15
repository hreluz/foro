<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $name = 'Hector Lavoe';
        $email = 'hlavoe@gmail.com';

        $user = factory(User::class)->create([
            'name' => $name,
            'email' => $email,
        ]);

        $this->actingAs($user, 'api')
                ->visit('api/user')
                ->see($name.' '.$email);
    }
}
