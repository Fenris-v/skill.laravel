<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostForm;
use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

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
     * @return Application|Factory|View
     */
    public function index()
    {
        $items = Post::publishedPosts()
            ->with('tags')
            ->with('user')
            ->latest()
            ->paginate(5);

        return view('main.index', compact('items'));
    }

    /**
     * Возвращает отображение детальной страницы статьи
     * Передает коллекцию конкретной статьи
     * @param Post $post
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('showPost', $post);

        $comments = $post->comments()->with('user')->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Возвращает отображение создания статьи
     * @return Application|Factory|View
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
     * @return Application|RedirectResponse|Redirector
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
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $post->load('history');

        return view('posts.edit', compact('post'));
    }

    /**
     * Обновление изменений
     * @param Post $post
     * @param PostForm $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Post $post, PostForm $request)
    {
        $validated = $request->validated();

        $validated['published'] = request()->input('published') ?? false;

        if ($request->slug) {
            $slug = $request->validate(
                [
                    'slug' => 'bail|regex:/^[a-zA-Z0-9_-]+$/|unique:posts,slug,' . $post->id
                ]
            );

            $validated['slug'] = $slug['slug'];
        } else {
            $post->generateSlug();
        }

        $post->update($validated);

        $post->syncTags($post);

        flash('Пост успешно изменен', 'success');

        return back();
    }

    /**
     * Удаление поста
     * @param Post $post
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash('Пост удален', 'danger');

        return redirect(route('posts.index'));
    }

    /**
     * Все неопубликованные посты
     * @param Post $post
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function showUnpublished(Post $post)
    {
        $this->authorize('showPost', $post);

        $posts = $post->unpublishedPosts()->latest()->get();

        return view('main.index', compact('posts'));
    }
}
