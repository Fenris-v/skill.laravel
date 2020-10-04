<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminCallbacksController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminPostsController;
use App\Http\Controllers\Admin\AdminTagsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PublishedPostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/** Статьи */
Route::get('/tags/{tag}', [TagsController::class, 'index'])->name('posts.tag');
Route::get('/posts/users/{user}', [UsersController::class, 'index'])->name('posts.by.user');
Route::get('/posts/unpublished', [PostsController::class, 'showUnpublished'])->name('posts.unpublished');


Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::resource('posts', PostsController::class)->except(['index']);
Route::post('/posts/{post}/publishing', [PublishedPostsController::class, 'store'])->name('posts.publishing');
Route::delete('/posts/{post}/publishing', [PublishedPostsController::class, 'destroy']);

/** Добавление комментариев */
Route::post('/posts/{post}/comment', [CommentController::class, 'postStore'])->name('comment.store.post');
Route::post('/news/{news}/comment', [CommentController::class, 'newsStore'])->name('comment.store.news');

/** Контакты и форма обратной связи */
Route::get('/contacts', [ContactsController::class, 'create'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store']);

/** О нас */
Route::get('/about', [AboutController::class, 'index'])->name('about');

/** Новости */
Route::resource('news', NewsController::class)->only(['index', 'show']);

/** Авторизация/регистрация */
Auth::routes();

/** Админка */
Route::group(
    ['prefix' => '/admin'],
    function () {
        Route::get('', [AdminController::class, 'index'])->name('admin');

        Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
        Route::get('/users/group/{group}', [AdminUsersController::class, 'show'])->name('admin.users.group');

        Route::resource('posts', AdminPostsController::class, ['as' => 'admin'])->only(['index', 'edit', 'update']);
        Route::get('/posts/published', [AdminPostsController::class, 'published'])->name('admin.posts.published');
        Route::get('/posts/unpublished', [AdminPostsController::class, 'unpublished'])->name('admin.posts.unpublished');

        Route::get('/posts/tag/{tag}', [AdminTagsController::class, 'index'])->name('admin.posts.tag');
        Route::get('/news/tag/{tag}', [AdminTagsController::class, 'indexNews'])->name('admin.news.tag');

        Route::get('/news/', [AdminNewsController::class, 'index'])->name('admin.news.index');
        Route::get('/news/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
        Route::patch('/news/{news}', [AdminNewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])->name('news.destroy');
        Route::get('/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
        Route::post('/news', [AdminNewsController::class, 'store'])->name('admin.news.store');

        Route::get('/feedbacks', [AdminCallbacksController::class, 'index'])->name('admin.callbacks');
    }
);
