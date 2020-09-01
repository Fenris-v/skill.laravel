<?php

namespace App\Http\Controllers;

use App\Post;

/**
 * Контроллер для публикации постов
 * Class PublishedPostsController
 * @package App\Http\Controllers
 */
class PublishedPostsController extends Controller
{
    public function store(Post $post)
    {
        $post->publishing();
        return back();
    }

    public function destroy(Post $post)
    {
        $post->unpublishing();
        return back();
    }
}
