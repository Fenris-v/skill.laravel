@component('mail::message')
# Пост опубликован: {{ $post->title }}

{{ $post->short_desc }}

@component('mail::button', ['url' => route('posts.show', $post->slug)])
Посмотреть
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
