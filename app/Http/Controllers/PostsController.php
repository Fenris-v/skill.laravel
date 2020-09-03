<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Collection;

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
        // TODO: я правильно понял, что достаточно в этом методе указать связь with() ?
        // TODO: как-то сомнительно, ведь этот метод вызывается только для определенной страницы,
        // TODO: а теги нужно выводить везде, где есть статья/статьи
        $posts = Post::publishedPosts()->with('tags')->with('user')->latest()->get();

        return view('main.index', compact('posts'));
    }

    /**
     * Возвращает отображение детальной страницы статьи
     * Передает коллекцию конкретной статьи
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        // TODO: сначала хотел сделать через PostPolicy,
        // TODO: но пользователь ведь может быть не авторизован.
        // TODO: Policy, на сколько я понял, относятся только к авторизованным пользователям?
        abort_unless(User::isAdmin() || $post->published, 403);

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
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Post $post)
    {
        $request = $this->validate(
            request(),
            [
                'title' => 'bail|required|min:5|max:100',
                'short_desc' => 'required|max:255',
                'text' => 'required',
            ]
        );

        $request['slug'] = $post->generateSlug($request['title']);

        $request['published'] = request()->input('published') ?? false;

        $request['user_id'] = auth()->id();

        $post = Post::create($request);

        $tags = collect(request('tags'))->keyBy(
            function ($item) {
                return $item;
            }
        );

        // TODO: Тот же вопрос, что и в методе update()
        foreach ($tags as $tag) {
            if (Tag::where('name', $tag)->first()) {
                $tag = Tag::where('name', $tag)->first();
            } else {
                $tag = Tag::create(['name' => $tag, 'slug' => (new Tag)->generateSlug($tag)]);
            }

            $post->tags()->attach($tag);
        }

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Post $post)
    {
        $request = $this->validate(
            request(),
            [
                'title' => 'bail|required|min:5|max:100',
                'short_desc' => 'required|max:255',
                'text' => 'required',
            ]
        );

        $request['published'] = request()->input('published') ?? false;

        $post->update($request);

        /** @var Collection $postTags */
        $postTags = collect($post->tags->keyBy('name'));

        $tags = collect(request('tags'))->keyBy(
            function ($item) {
                return $item;
            }
        );

        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();

        $tagsToAttach = $tags->diffKeys($postTags);

        // TODO: Я хочу здесь вызывать метод, который будет генерировать адрес для нового тега.
        // TODO: (не хочется делать как в уроке с выводом имени тега в адресной строке)
        // TODO: Но мне кажется, что этот код излишне сложен и его можно оптимизировать
        foreach ($tagsToAttach as $tag) {
            if (Tag::where('name', $tag)->first()) {
                $tag = Tag::where('name', $tag)->first();
            } else {
                $tag = Tag::create(['name' => $tag, 'slug' => (new Tag)->generateSlug($tag)]);
            }

            $syncIds[] = $tag->id;
        }

        $post->tags()->sync($syncIds);

        flash('Пост успешно изменен', 'success');

        return redirect(route('postShow', $post->getRouteKey()));
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

        return redirect(route('mainPage'));
    }

    /**
     * Все неопубликованные посты
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showUnpublished(Post $post)
    {
        $this->authorize('viewAny', $post);

        $posts = Post::unpublishedPosts()->latest()->get();

        return view('main.index', compact('posts'));
    }
}
