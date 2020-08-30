<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PostsController@index')->name('mainPage');
Route::get('/posts/create', 'PostsController@create')->name('postsCreate');
Route::get('/posts/{post}', 'PostsController@show')->name('postShow');
Route::post('/', 'PostsController@store');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('postEdit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');
Route::patch('/posts/{post}/published', 'PostsController@publishing')->name('postPublishing');

Route::get('/unpublished', 'PostsController@showUnpublished')->name('unpublishedPosts');

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
Route::get('/logout', function () {
        return redirect(RouteServiceProvider::HOME);
});
