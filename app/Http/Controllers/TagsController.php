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
    // TODO: Есть ли иной способ загрузить сразу все модели связанные с тегом, а не только указанные?
    public function index(Tag $tag)
    {
        // TODO: Этот код довольно странным кажется.
        // TODO: Я получаю 2 коллекции, затем их нужно объединить, для этого создать новую,
        // TODO: пройти циклом, после отсортировать.
        // TODO: Кажется что много лишних действий, но я не нашел способа получить модели сразу в одну коллекцию.
        // TODO: Если есть более оптимальный способ, прошу подсказать.
        $relations = $tag->load(
            [
                'news' => function ($query) {
                    $query->with('tags');
                },
                'posts' => function ($query) {
                    $query->with('tags', 'user');
                }
            ]
        )->getRelations();

        $items = collect();
        foreach ($relations as $relation) {
            $items = $items->merge($relation);
        }

        $items = $items->sortByDesc('created_at');

        return view('main.index', compact('items'));
    }
}
