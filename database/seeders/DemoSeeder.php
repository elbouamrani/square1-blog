<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create()->each(function($user) {
            $user->posts()->saveMany(\App\Models\Post::factory(rand(0, 8))->make());
        });
    }
}
