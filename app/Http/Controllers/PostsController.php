<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;

/**
 * Придерживаемся общепринятого наименования методов контроллера
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    /**
     * Возвращает отображение главной страницы
     * Передает в нее выборку статей
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::published()->latest()->get();

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
//        dd(request()->all());

        $request = $this->validate(
            request(),
            [
                'title' => 'bail|required|min:5|max:100',
                'short_desc' => 'required|max:255',
                'text' => 'required',
            ]
        );

        $request['slug'] = $this->generateSlug($request['title']);

        $request['published'] = request()->input('published') ?? false;

        Post::create($request);

        return redirect('/');
    }

    /**
     * Изменение поста
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
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

        return redirect(route('postShow', $post->slug));
    }

    /**
     * Удаление поста
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('mainPage'));
    }

    /**
     * Генерирует url,
     * проверяет его на уникальность и дописывает номера,
     * пока url не станет уникальным
     *
     * @param string $str
     * @return string
     */
    private function generateSlug(string $str): string
    {
        $slug = Str::slug($str);

        if (Post::all()->where('slug', $slug)->first()) {
            $i = 2;
            while (Post::all()->where('slug', $slug . $i)->first()) {
                $i++;
            }

            $slug .= $i;
        }

        return $slug;
    }
}
