@component('mail::message')
# Создана новая статья: {{ $post->title }}

{{ $post->short_desc }}

@component('mail::button', ['url' => route('postShow', $post->slug)])
Посмотреть
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
