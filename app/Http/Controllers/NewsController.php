<?php

namespace App\Http\Controllers;

use App\Models\News;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        $page = request()->has('page') ? (int)$request->query('page') : 1;

        $items = Cache::tags(['news'])->remember(
            'news_page_' . $page,
            3600 * 24,
            function () {
                return News::latest()->with('tags')->paginate(5);
            }
        );

        return view('main.index', compact('items'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|Response|View
     */
    public function show(string $slug)
    {
        $news = Cache::tags(['news', 'news_' . $slug])->remember(
            'news_' . $slug,
            3600 * 24,
            function () use ($slug) {
                return News::where('slug', $slug)->first();
            }
        );

        $comments = Cache::tags(['comments', 'comments_news_' . $news->id])->remember(
            'comments_news_' . $news->id,
            3600 * 24,
            function () use ($news) {
                return $news->comments()->with('user')->latest()->get();
            }
        );

        return view('news.show', compact('news', 'comments'));
    }
}
