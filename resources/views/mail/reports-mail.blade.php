@component('mail::message')
    # Отчет готов: {{ $file }}

    Спасибо, {{ PHP_EOL }}
    {{ config('app.name') }}
@endcomponent
