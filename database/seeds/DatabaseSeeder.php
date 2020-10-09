<?php

use Database\Seeders\NewsSeeder;
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
        $this->call(
            [
                GroupsSeeder::class,
                TagsSeeder::class,
                UsersSeeder::class,
                GroupUserSeeder::class,
                NewsSeeder::class,
                PostTagSeeder::class,
            ]
        );
    }
}
