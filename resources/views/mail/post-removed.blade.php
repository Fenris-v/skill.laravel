@component('mail::message')
# Статья удалена: {{ $post->title }}

@component('mail::button', ['url' => route('mainPage')])
Перейти на сайт
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
