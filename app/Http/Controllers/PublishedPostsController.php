<?php

namespace App\Http\Controllers;

use App\Notifications\PostPublished;
use App\Models\Post;

/**
 * Контроллер для публикации постов
 * Class PublishedPostsController
 * @package App\Http\Controllers
 */
class PublishedPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Публикует статью
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Post $post)
    {
        $post->publishing();

        /** Уведомляет пользователя */
        $post->user->notify(new PostPublished($post));

        flash('Пост опубликован');

        return back();
    }

    /**
     * Снимает статью с публикации
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->unpublishing();

        flash('Пост снят с публикации', 'warning');

        return back();
    }
}
