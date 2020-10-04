<?php

namespace App\Http\Controllers;

use App\Models\News;
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
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $items = News::latest()->with('tags')->paginate(5);

        return view('main.index', compact('items'));
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return Application|Factory|Response|View
     */
    public function show(News $news)
    {
        $comments = $news->comments()->with('user')->latest()->get();

        return view('news.show', compact('news', 'comments'));
    }
}
