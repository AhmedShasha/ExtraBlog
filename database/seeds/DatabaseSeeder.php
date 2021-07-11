<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\Post::class, 20)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        });
    }
}
