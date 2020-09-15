<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostForm;
use App\Models\Post;
use App\Models\User;

/**
 * Придерживаемся общепринятого наименования методов контроллера
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Возвращает отображение главной страницы
     * Передает в нее выборку статей
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::publishedPosts()
            ->with('tags')
            ->with('user')
            ->latest()
            ->get();

        return view('main.index', compact('posts'));
    }

    /**
     * Возвращает отображение детальной страницы статьи
     * Передает коллекцию конкретной статьи
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('showPost', $post);

        return view('posts.show', compact('post'));
    }

    /**
     * Возвращает отображение создания статьи
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Метод, который валидирует и добавляет статьи в БД.
     * В случае успеха - выполняет редирект на главную.
     * В случае ошибки - возвращает на страницу создания статьи.
     * @param PostForm $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostForm $request)
    {
        $validated = $request->validated();

        $validated['published'] = request()->input('published') ?? false;

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $post->syncTags($post);

        /** Сохраняет в сессию на 1 переход */
        flash('Пост успешно создан', 'success');

        return redirect('/');
    }

    /**
     * Изменение поста
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Обновление изменений
     * @param Post $post
     * @param PostForm $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Post $post, PostForm $request)
    {
        $validated = $request->validated();

        $validated['published'] = request()->input('published') ?? false;

        $post->update($validated);

        $post->syncTags($post);

        flash('Пост успешно изменен', 'success');

        return redirect(route('posts.show', $post->getRouteKey()));
    }

    /**
     * Удаление поста
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash('Пост удален', 'danger');

        return redirect(route('posts.index'));
    }

    /**
     * Все неопубликованные посты
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showUnpublished()
    {
        abort_if(!User::isAdmin(), 403);

        $posts = Post::unpublishedPosts()->latest()->get();

        return view('main.index', compact('posts'));
    }
}
