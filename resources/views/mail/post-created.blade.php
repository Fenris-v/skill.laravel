@component('mail::message')
# Создана новая статья: {{ $post->title }}

{{ $post->short_desc }}

@component('mail::button', ['url' => route('posts.show', $post->slug)])
Посмотреть
@endcomponent

<span style="color: red;">*\*Ссылка будет доступна после публикации*</span>

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
