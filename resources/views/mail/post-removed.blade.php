@component('mail::message')
# Статья удалена: {{ $post->title }}

@component('mail::button', ['url' => route('posts.index')])
Перейти на сайт
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
