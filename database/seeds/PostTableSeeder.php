<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = Category::select('id')->get();

    	for ($i=0; $i < 100 ; $i++):
    		factory(Post::class)->create([
    			'category_id' => $categories->random()->id
    		]);
    	endfor;
    }
}
