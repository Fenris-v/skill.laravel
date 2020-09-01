<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/posts/tags/{tag}', 'TagsController@index')->name('postsByTag');

Route::get('/posts/users/{user}', 'UsersController@index')->name('postsByUser');

/**
 * Следующие маршруты можно было бы заменить на
 * Route::resource('/posts', 'PostsController');
 * Но тогда список статей был бы не на главной, а на '/posts'
 */
// TODO: а если использовать Route::resource(),
// TODO: то исчезает возможность использовать именованные маршруты?
Route::get('/', 'PostsController@index')->name('mainPage');
Route::get('/posts/create', 'PostsController@create')->name('postsCreate');
Route::get('/posts/{post}', 'PostsController@show')->name('postShow');
Route::post('/', 'PostsController@store');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('postEdit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');

// TODO: на сколько корректным является добавление своих маршрутов, не общепринятых?
// TODO: мне кажется следующий имеет место быть в моей реализации
// TODO: создавать отдельный контроллер тут, мне кажется будет лишним
Route::get('/unpublished', 'PostsController@showUnpublished')->name('unpublishedPosts');

Route::post('/publishing-posts/{post}', 'PublishedPostsController@store')->name('postPublishing');
Route::delete('/publishing-posts/{post}', 'PublishedPostsController@destroy');

Route::get('/admin/feedbacks', 'ContactsController@index')->name('callbacksList');
Route::get('/contacts', 'ContactsController@create')->name('contacts');
Route::post('/contacts', 'ContactsController@store');

Route::get('/about', 'AboutController@index')->name('about');

Auth::routes();
// TODO: Меня смущало то, что при гет запросе на /logout выдавалась ошибка
// TODO: Прошу прокомментировать такое решение.
// TODO: Наверное, лучше было бы через middleware,
// TODO: но, как я понял, всё равно ведь маршрут пришлось бы регистрировать,
// TODO: т.к. в Auth::routes() его нет, а это простое решение,
// TODO: ведь ничего кроме редиректа здесь не нужно
Route::get(
    '/logout',
    function () {
        return redirect(RouteServiceProvider::HOME);
    }
);
