<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Рабочий стол
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $statistic = [];
        $statistic['allUsersCount'] = User::count();
        $statistic['mostPublishingUser'] = User::withCount('posts')->orderByDesc('posts_count')->first();
        $statistic['activeUsersCount'] = User::has('posts', '>', 1)->count();

        $statistic['averagePostsCount'] = round(
            User::has('posts', '>', 1)->withCount('posts')->get()->avg('posts_count'),
            2
        );

        $posts = Post::select(DB::raw('count(id) as post_count, published'))->groupBy('published')->get();
        foreach ($posts as $post) {
            if ($post->published) {
                $statistic['postPublished'] = $post->post_count;
            } else {
                $statistic['postUnpublished'] = $post->post_count;
            }
        }

        $statistic['postsCount'] = Post::count();
        $statistic['mostLongPost'] = Post::select('title', 'text')->orderByRaw('LENGTH(text) desc')->first();
        $statistic['mostShortPost'] = Post::select('title', 'text')->orderByRaw('LENGTH(text)')->first();

        $statistic['mostCommentingPost'] = Post::withCount('comments')->orderByDesc('comments_count')->first();
        $statistic['mostEditingPost'] = Post::withCount('history')->orderByDesc('history_count')->first();

        $statistic['news'] = News::count();

        return view('admin.index', compact('statistic'));
    }

    /**
     * Пользователи
     *
     * @return Application|Factory|View
     */
    public function users()
    {
        return view('admin.users');
    }
}
