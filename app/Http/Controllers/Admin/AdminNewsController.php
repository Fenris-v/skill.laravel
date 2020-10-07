<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentForm;
use App\Models\News;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class AdminNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $items = News::all()->sortByDesc('created_at');

        return view('admin.posts.index', compact('items'));
    }

    /**
     * Возвращает отображение создания новости
     * @return Application|Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Метод, который валидирует и добавляет статьи в БД.
     * В случае успеха - выполняет редирект на главную.
     * В случае ошибки - возвращает на страницу создания статьи.
     * @param CommentForm $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CommentForm $request)
    {
        $validated = $request->validated();

        $validated['published'] = request()->input('published') ?? false;

        $validated['user_id'] = auth()->id();

        $post = News::create($validated);

        $post->syncTags($post);

        /** Сохраняет в сессию на 1 переход */
        flash('Пост успешно создан', 'success');

        return redirect(route('admin.news.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return Application|Factory|View|Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentForm $request
     * @param News $news
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(CommentForm $request, News $news)
    {
        $validated = $request->validated();

        if ($request->slug) {
            $slug = $request->validate(
                [
                    'slug' => 'bail|regex:/^[a-zA-Z0-9_-]+$/|unique:news,slug,' . $news->id
                ]
            );

            $validated['slug'] = $slug['slug'];
        } else {
            $news->generateSlug();
        }

        $news->update($validated);

        $news->syncTags($news);

        return redirect(route('admin.news.index', $news->getRouteKey()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return Application|RedirectResponse|Response|Redirector
     * @throws Exception
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect(route('admin.news.index'));
    }
}
