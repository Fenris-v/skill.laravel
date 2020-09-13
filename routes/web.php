<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PublishedPostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/posts/tags/{tag}', [TagsController::class, 'index'])->name('postsByTag');

Route::get('/posts/users/{user}', [UsersController::class, 'index'])->name('postsByUser');

/**
 * Следующие маршруты можно было бы заменить на
 * Route::resource('/posts', 'PostsController');
 * Но тогда список статей был бы не на главной, а на '/posts'
 */
// TODO: а если использовать Route::resource(),
// TODO: то исчезает возможность использовать именованные маршруты?
Route::get('/', [PostsController::class, 'index'])->name('mainPage');
Route::get('/posts/create', [PostsController::class, 'create'])->name('postsCreate');
Route::get('/posts/{post}', [PostsController::class, 'show'])->name('postShow');
Route::post('/', [PostsController::class, 'store']);
Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('postEdit');
Route::patch('/posts/{post}', [PostsController::class, 'update']);
Route::delete('/posts/{post}', [PostsController::class, 'destroy']);

// TODO: на сколько корректным является добавление своих маршрутов, не общепринятых?
// TODO: мне кажется следующий имеет место быть в моей реализации
// TODO: создавать отдельный контроллер тут, мне кажется будет лишним
Route::get('/unpublished', [PostsController::class, 'showUnpublished'])->name('unpublishedPosts');

Route::post('/publishing-posts/{post}', [PublishedPostsController::class, 'store'])->name('postPublishing');
Route::delete('/publishing-posts/{post}', [PublishedPostsController::class, 'destroy']);

Route::get('/admin/feedbacks', [ContactsController::class, 'index'])->name('callbacksList');
Route::get('/contacts', [ContactsController::class, 'create'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/about', [AboutController::class, 'index'])->name('about');

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
