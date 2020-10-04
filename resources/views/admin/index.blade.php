@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    {{--TODO: Либо я что-то делаю не так, либо возникает вопрос.--}}
    {{--TODO: Зачем каждый раз обращаться к БД, если можно получить коллекцию моделей--}}
    {{--TODO: и провести все необходимые операции с ней, вместо того, чтобы создавать кучу запросов к БД?--}}

    {{--TODO: И на сколько я понимаю, эта логика по хорошему должна быть в контроллере же?--}}
    {{--TODO: Нужно, на сколько я понимаю, стараться избегать прямого обращения отображения к модели?--}}

    <p class="h2">Всего статей на сайте: {{ App\Models\Post::count() }}</p>
    <p class="h2">Опубликованных статей на сайте: {{ App\Models\Post::where('published', true)->count() }}</p>
    <p class="h2">Неопубликованных статей на сайте: {{ App\Models\Post::where('published', false)->count() }}</p>
    <p class="h2">Всего новостей на сайте: {{ App\Models\News::count() }}</p>
    <p class="h2">Самый публикуемый автор: {{  App\Models\User::withCount('posts')->get()->sortByDesc('posts_count')->first()->name }}</p>
    <p class="h2">Зарегистрированных пользователей: {{ \App\Models\User::all()->count() }}</p>
    <p class="h2">Самый длинный пост: {{ \App\Models\Post::all()->sortBy('text_length')->last()->title . '. Длина: ' . \App\Models\Post::all()->sortBy('text_length')->last()->text_length . ' символов' }}</p>
    <p class="h2">Самый короткий пост: {{ \App\Models\Post::all()->sortBy('text_length')->first()->title . '. Длина: ' . \App\Models\Post::all()->sortBy('text_length')->first()->text_length . ' символов' }}</p>
    <p class="h2">Самый комментируемый пост: {{ \App\Models\Post::withCount('comments')->get()->sortByDesc('comments_count')->first()->title }}</p>
    <p class="h2">Самый редактируемый пост: {{ \App\Models\Post::withCount('history')->get()->sortByDesc('history_count')->first()->title }}</p>
    <p class="h2">Количество активных пользователей: {{ App\Models\User::withCount('posts')->get()->where('posts_count', '>', 1)->count() }}</p>

@endsection
