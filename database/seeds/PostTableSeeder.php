<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use Carbon\Carbon;

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
    			'category_id' => $categories->random()->id,
                'created_at' => Carbon::now()->subHours(rand(0,720))
    		]);
    	endfor;
    }
}
