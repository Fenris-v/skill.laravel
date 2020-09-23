<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AdminPostsController extends Controller
{
    /**
     * Статьи
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Опубликованные посты
     * @return Application|Factory|View
     */
    public function published()
    {
        $posts = Post::publishedPosts()->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Неопубликованные посты
     * @return Application|Factory|View
     */
    public function unpublished()
    {
        $posts = Post::unpublishedPosts()->get();

        return view('admin.posts.index', compact('posts'));
    }
}
