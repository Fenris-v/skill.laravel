@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    <p class="h2">Всего статей на сайте: {{ $statistic['postsCount'] }}</p>
    <p class="h2">Опубликованных статей на сайте: {{ $statistic['postPublished'] }}</p>
    <p class="h2">Неопубликованных статей на сайте: {{ $statistic['postUnpublished'] }}</p>
    <p class="h2">Всего новостей на сайте: {{ $statistic['news'] }}</p>
    <p class="h2">Самый публикуемый автор: {{  $statistic['mostPublishingUser']->name }}</p>
    <p class="h2">Зарегистрированных пользователей: {{ $statistic['allUsersCount'] }}</p>
    <p class="h2">Самый короткий пост: {{ $statistic['mostLongPost']->title . '. Длина: '
        . mb_strlen($statistic['mostLongPost']->text) . ' символов' }}</p>
    <p class="h2">Самый длинный пост: {{ $statistic['mostShortPost']->title . '. Длина: '
        . mb_strlen($statistic['mostShortPost']->text) . ' символов' }}</p>
    <p class="h2">Самый комментируемый
        пост: {{ $statistic['mostCommentingPost']->title ?? 'Комментариев не найдено' }}</p>
    <p class="h2">Самый редактируемый
        пост: {{ $statistic['mostEditingPost']->title ?? 'Ни один пост не редактировался' }}</p>
    <p class="h2">Количество активных
        пользователей: {{ $statistic['activeUsersCount'] }}</p>
    <p class="h2">Среднее количество статей у активных пользователей: {{ $statistic['averagePostsCount'] }}</p>

@endsection
