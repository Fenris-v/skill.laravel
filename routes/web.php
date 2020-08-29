<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostsController@index')->name('mainPage');
Route::get('/posts/create', 'PostsController@create')->name('postsCreate');
Route::get('/posts/{post}', 'PostsController@show')->name('postShow');
Route::post('/', 'PostsController@store');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('postEdit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');

Route::get('/admin/feedbacks', 'ContactsController@index')->name('callbacksList');
Route::get('/contacts', 'ContactsController@create')->name('contacts');
Route::post('/contacts', 'ContactsController@store');

Route::get('/about', 'AboutController@index')->name('about');
