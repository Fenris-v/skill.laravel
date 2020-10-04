<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AdminPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Статьи
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $items = Post::all()->sortByDesc('created_at');

        return view('admin.posts.index', compact('items'));
    }

    /**
     * Редактирование поста
     * @param Post $post
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
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
        $items = Post::publishedPosts()->get();

        return view('admin.posts.index', compact('items'));
    }

    /**
     * Неопубликованные посты
     * @return Application|Factory|View
     */
    public function unpublished()
    {
        $items = Post::unpublishedPosts()->get();

        return view('admin.posts.index', compact('items'));
    }
}
