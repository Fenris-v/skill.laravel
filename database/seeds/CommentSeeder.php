<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Post::all() as $post) {
            $post->comments()->saveMany(Comment::factory()->count(rand(1, 5))->make());
        }

        foreach (News::all() as $news) {
            $news->comments()->saveMany(Comment::factory()->count(rand(1, 5))->make());
        }
    }
}
