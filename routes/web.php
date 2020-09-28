<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminCallbacksController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPostsController;
use App\Http\Controllers\Admin\AdminTagsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PublishedPostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;

Route::get('/posts/tags/{tag}', [TagsController::class, 'index'])->name('posts.tag');
Route::get('/posts/users/{user}', [UsersController::class, 'index'])->name('posts.by.user');
Route::get('/posts/unpublished', [PostsController::class, 'showUnpublished'])->name('posts.unpublished');


Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::resource('posts', 'PostsController')->except(['index']);
Route::post('/posts/{post}/publishing', [PublishedPostsController::class, 'store'])->name('posts.publishing');
Route::delete('/posts/{post}/publishing', [PublishedPostsController::class, 'destroy']);

Route::get('/contacts', [ContactsController::class, 'create'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/about', [AboutController::class, 'index'])->name('about');

Auth::routes();

/** Админка */
Route::group(
    ['prefix' => '/admin'],
    function () {
        Route::get('', [AdminController::class, 'index'])->name('admin');

        Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
        Route::get('/users/group/{group}', [AdminUsersController::class, 'show'])->name('admin.users.group');

        Route::resource('posts', 'Admin\AdminPostsController', ['as' => 'admin'])->only(['index', 'edit', 'update']);
        Route::get('/posts/published', [AdminPostsController::class, 'published'])->name('admin.posts.published');
        Route::get('/posts/unpublished', [AdminPostsController::class, 'unpublished'])->name('admin.posts.unpublished');

        Route::get('/posts/tag/{tag}', [AdminTagsController::class, 'index'])->name('admin.posts.tag');

        Route::get('/feedbacks', [AdminCallbacksController::class, 'index'])->name('admin.callbacks');
    }
);
