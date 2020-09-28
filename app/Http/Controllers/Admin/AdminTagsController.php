<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AdminTagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Статьи по тегам
     *
     * @param Tag $tag
     * @return Application|Factory|Response|View
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->latest()->with('tags')->get();

        return view('admin.posts.index', compact('posts'));
    }
}
