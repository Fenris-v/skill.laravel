@component('mail::message')
# Еженедельная рассылка

Свежие статьи за неделю:

@include('mail.weekly-list', ['posts' => $posts])

@component('mail::button', ['url' => ''])
Перейти на сайт
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
