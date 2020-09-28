@php
    use App\Models\Post;
    $posts = Post::all()
@endphp

@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

        <p class="h2">Всего статей на сайте: {{ $posts->count() }}</p>
        <p class="h2">Опубликованных статей на сайте: {{ $posts->where('published', true)->count() }}</p>
        <p class="h2">Неопубликованных статей на сайте: {{ $posts->where('published', false)->count() }}</p>
        <p class="h2">Зарегистрированных пользователей: {{ \App\Models\User::all()->count() }}</p>

@endsection
