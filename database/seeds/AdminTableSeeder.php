<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(User::class)->create([
    		'first_name' => 'Hector',
    		'last_name' => 'Lavoe',
    		'username' => 'hlavoe',
    		'email' => 'hlavoe@something.com',
    		'role' => 'admin'
    	]);
    }
}
