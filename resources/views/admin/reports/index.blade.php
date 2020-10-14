@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    <h1 class="mb-5">Отчеты</h1>

    <form action="{{ route('admin.reports.get') }}" method="post">
        @csrf
        <div class="input-group mb-5">
            <div class="input-group-prepend">
                <label class="input-group-text" for="get-reports">Итого</label>
            </div>
            <select required class="custom-select" multiple name="get_reports[]" id="get-reports">
                <option value="{{ \App\Service\PrepareReport::ALL_TO_REPORT }}">Все</option>
                <option value="{{ \App\Service\PrepareReport::NEWS_TO_REPORT }}">Новостей</option>
                <option value="{{ \App\Service\PrepareReport::POSTS_TO_REPORT }}">Статей</option>
                <option value="{{ \App\Service\PrepareReport::COMMENTS_TO_REPORT }}">Комментариев</option>
                <option value="{{ \App\Service\PrepareReport::TAGS_TO_REPORT }}">Тегов</option>
                <option value="{{ \App\Service\PrepareReport::USERS_TO_REPORT }}">Пользователей</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Сгенерировать отчет</button>
    </form>

    <reports-requested user-id="{{ auth()->id() }}"></reports-requested>

@endsection
