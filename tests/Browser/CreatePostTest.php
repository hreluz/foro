<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Post;
use App\Category;

class CreatePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $title = 'Esta es una pregunta';
    protected $content = 'Este es el contenido';

    function test_a_user_create_a_post()
    {
        //Having
        $user = $this->defaultUser();

        $category = factory(Category::class)->create();

        $this->browse(function($browser) use($user, $category) {
            $browser->loginAs($user)
                ->visitRoute('posts.create')
                ->type('title', $this->title)
                ->type('content', $this->content)
                ->select('category_id', $category->id)
                ->press('Publicar')

                //Test a user is redirected to the posts details after creating it
                ->assertPathIs('/posts/1-esta-es-una-pregunta');
        });

        //Then
        $this->assertDatabaseHas('posts',[
            'title' => $this->title,
            'content' => $this->content,
            'pending' => true,
            'user_id' => $user->id
        ]);

        $post = Post::first();

        $this->assertDatabaseHas('subscriptions',[
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);
    }

    function test_creating_a_post_requires_authentication()
    {
        $this->browse(function($browser) {
            $browser->visitRoute('posts.create')
                ->assertRouteIs('token');

        });
    }   

    function test_create_post_form_validation()
    {
        $user = $this->defaultUser();

        $this->browse(function($browser) use($user) {
            $browser->loginAs($user)
                ->visitRoute('posts.create')
                ->press('Publicar')
                ->assertRouteIs('posts.create')
                ->assertSeeErrors([
                    'title' => 'El campo título es obligatorio',
                    'content' => 'El campo contenido es obligatorio'
                ]);
        });
    }
}
