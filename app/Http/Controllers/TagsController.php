<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Страница статей по тегу
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->publishedPosts()->latest()->with('tags')->get();

        return view('main.index', compact('posts'));
    }
}
