<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Cache;
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
        $relations = Cache::tags(['tags', 'news', 'posts'])->remember(
            'tag_' . $tag->id,
            3600 * 24,
            function () use ($tag) {
                return $tag->load(
                    [
                        'news' => function ($query) {
                            $query->with('tags');
                        },
                        'posts' => function ($query) {
                            $query->with('tags', 'user')->publishedPosts();
                        }
                    ]
                )->getRelations();
            }
        );


        $items = collect();
        foreach ($relations as $relation) {
            $items = $items->merge($relation);
        }

        $items = $items->sortByDesc('created_at');

        return view('main.index', compact('items', 'tag'));
    }
}
