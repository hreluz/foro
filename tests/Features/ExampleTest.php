<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ExampleTest extends FeatureTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_basic_example()
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
