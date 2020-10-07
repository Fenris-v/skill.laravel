<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $statistic['allUsersCount'] = DB::table('users')->count();
        $statistic['mostPublishingUser'] = DB::table('users')->join('posts', 'users.id', '=', 'user_id')->select('users.id', 'name')->orderByRaw('count(posts.id) desc')->groupBy('users.id')->first();
        // TODO: Здесь наверное не нужно создавать коллекцию,
        // TODO: но без нее у меня почему-то получается неправильный результат
        $statistic['activeUsersCount'] = DB::table('users')->join('posts', 'users.id', '=', 'user_id')->select('users.id')->havingRaw('count(posts.id) > ?', [1])->groupBy('users.id')->get()->count();

        // TODO: Аналогично, не уверен, что нужна коллекция
        $statistic['averagePostsCount'] = round(DB::table('users')->join('posts', 'users.id', '=', 'user_id')->select('users.id')->havingRaw('count(posts.id) > ? ', [1])->selectRaw('count(posts.id) as posts_count')->groupBy('users.id')->get()->avg('posts_count'), 2);

        $posts = DB::table('posts')->select(DB::raw('count(id) as post_count, published'))->groupBy('published')->get();
        foreach ($posts as $post) {
            if ($post->published) {
                $statistic['postPublished'] = $post->post_count;
            } else {
                $statistic['postUnpublished'] = $post->post_count;
            }
        }

        $statistic['postsCount'] = DB::table('posts')->count('id');
        $statistic['mostLongPost'] = DB::table('posts')->select('title', 'text')->orderByRaw('LENGTH(text)')->first();
        $statistic['mostShortPost'] = DB::table('posts')->select('title', 'text')->orderByRaw('LENGTH(text) DESC')->first();

        $statistic['mostCommentingPost'] = DB::table('posts')->join('comments', 'comments.commentable_id', '=', 'posts.id')->select('posts.id', 'title')->orderByRaw('count(comments.id) desc')->groupBy('posts.id')->first();
        $statistic['mostEditingPost'] = DB::table('posts')->join('post_histories', 'posts.id', '=', 'post_id')->select('posts.id', 'title')->orderByRaw('count(post_histories.id)')->groupBy('posts.id')->first();

        $statistic['news'] = DB::table('news')->count('id');

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
