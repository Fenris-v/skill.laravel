<?php

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
        User::factory()
            ->count(2)
            ->has(
                Post::factory()
                    ->count(rand(10, 20))
                    // TODO: Следующая строчка создает равное количество комментариев для статей,
                    // TODO: например, если случайное число 3, то для всех статей будет по 3 комментария,
                    // TODO: а не для каждой статьи случайное число.
                    // TODO: Та же ситуация и с постами пользователя на самом деле, у всех равное количество.
                    ->has(Comment::factory()->count(rand(1, 5)), 'comments'),
                'posts'
            )
            ->create();
    }
}
