@component('mail::message')
# Пост снят с публикации: {{ $post->title }}

{{ $post->short_desc }}

@component('mail::button', ['url' => route('mainPage')])
Перейти на сайт
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
