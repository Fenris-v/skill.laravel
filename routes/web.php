<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PublishedPostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/posts/tags/{tag}', [TagsController::class, 'index'])->name('posts.tag');

Route::get('/posts/users/{user}', [UsersController::class, 'index'])->name('postsByUser');

Route::get('/posts/unpublished', [PostsController::class, 'showUnpublished'])->name('posts.unpublished');


Route::get('/', [PostsController::class, 'index'])->name('posts.index');

// TODO: По какой-то причине не работает запись вида:
/** Route::resource('posts', PostsController::class)->except(['index']); */
// TODO: Можете прокомментировать? Есть предположение, что баг Laravel 8, т.к. судя по докам, раньше нельзя было так писать
// TODO: Ошибка заключается в неймспейсе, ларавел пытается найти класс в несуществующем неймспейсе:
/** Target class [App\Http\Controllers\App\Http\Controllers\PostsController] does not exist. */
Route::resource('posts', 'PostsController')->except(['index']);

Route::post('/posts/{post}/publishing', [PublishedPostsController::class, 'store'])->name('posts.publishing');
Route::delete('/posts/{post}/publishing', [PublishedPostsController::class, 'destroy']);

Route::get('/admin/feedbacks', [ContactsController::class, 'index'])->name('callbacks.list');

Route::get('/contacts', [ContactsController::class, 'create'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/about', [AboutController::class, 'index'])->name('about');

Auth::routes();
