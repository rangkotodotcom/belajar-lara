<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Posts;
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

        User::create([
            'name'  => 'Jamilur',
            'username'  => 'bgj4m',
            'email' => 'softj4m98@gmail.com',
            'password' => bcrypt('passowrd')
        ]);

        User::factory(4)->create();

        Category::create([
            'name'  => 'Web Programming',
            'slug'  => 'web-programming'
        ]);

        Category::create([
            'name'  => 'Networking',
            'slug'  => 'networking'
        ]);

        Posts::factory(20)->create();
    }
}
