<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
    	'title'  => $faker->title,
    	'content' => $faker->text,
    	'pending' => true,
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'category_id' => function(){
            return factory(App\Category::class)->create()->id;
        }
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    
    return [
        'comment'  => $faker->text,
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'post_id' => function(){
            return factory(App\Post::class)->create()->id;
        },
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    $name = $faker->unique()->sentence;

    return [
        'name' => $name,
        'slug' => str_slug($name)
    ];
});
