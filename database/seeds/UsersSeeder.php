<?php

use App\Events\PostCreated;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::forget(PostCreated::class);
        User::factory()
            ->count(2)
            ->has(
                Post::factory()
                    ->count(rand(10, 20))
                    ->has(Comment::factory()->count(rand(1, 5)), 'comments'),
                'posts'
            )
            ->create();
    }
}
