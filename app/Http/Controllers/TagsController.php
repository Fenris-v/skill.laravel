<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class TagsController extends Controller
{
    /**
     * Страница статей по тегу
     * @param Tag $tag
     * @return Application|Factory|View
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->publishedPosts()->latest()->with('tags')->get();

        return view('main.index', compact('posts'));
    }
}
