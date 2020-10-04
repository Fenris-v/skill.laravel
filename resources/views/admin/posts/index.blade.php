@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')
    @switch(url()->current())
        @case(route('admin.news.index'))
        @php($type = 'news')
        @break
        @case(route('admin.news.tag', $tag->slug ?? ''))
        @php($type = 'news')
        @break
        @default
        @php($type = 'posts')
    @endswitch

    @if($type === 'news')
        <a class="btn btn-primary" href="{{ route('admin.news.create') }}">Добавить новость</a>
    @endif

    <div class="row">
        @if($type === 'posts')
            <div class="col">
                <h2 class="h2">Статус</h2>
                <ul class="d-flex flex-wrap list-unstyled">
                    <li class="mr-3">
                        <a class="btn btn-primary {{ url()->current() === route('admin.posts.index') ? 'active' : '' }}"
                           href="{{ route('admin.posts.index') }}">Все</a>
                    </li>
                    <li class="mr-3">
                        <a class="btn btn-primary {{ url()->current() === route('admin.posts.published')
                        ? 'active' : '' }}" href="{{ route('admin.posts.published') }}">Опубликованные</a>
                    </li>
                    <li class="mr-3">
                        <a class="btn btn-primary {{ url()->current() === route('admin.posts.unpublished')
                        ? 'active' : '' }}" href="{{ route('admin.posts.unpublished') }}">Неопубликованные</a>
                    </li>
                </ul>
            </div>
        @endif

        <div class="col">
            <h2 class="h2">Теги</h2>
            <ul class="d-flex flex-wrap list-unstyled">
                <li class="mr-3">
                    <a class="btn btn-primary {{ url()->current() === route("admin.$type.index") ? 'active' : '' }}"
                       href="{{ route("admin.$type.index") }}">Все</a>
                </li>
                @foreach(\App\Models\Tag::all() as $tag)
                    <li class="mr-3 mb-2">
                        <a class="btn btn-primary {{ url()->current() === route("admin.$type.tag", $tag->slug) ? 'active' : '' }}"
                           href="{{ route("admin.$type.tag", $tag->slug) }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Адрес</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Изменить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($items as $post)
            <tr>
                <th class="font-weight-normal" scope="col">{{ $post->title }}</th>
                <th class="font-weight-normal" scope="col">{{ $post->slug }}</th>
                <th class="font-weight-normal"
                    scope="col">{{ $post->updated_at ? $post->updated_at->isoFormat('D MMM YYYY H:m:s') : '' }}</th>
                <th class="font-weight-normal"
                    scope="col">{{ $post->created_at ? $post->created_at->isoFormat('D MMM YYYY H:m:s') : '' }}</th>
                <th class="font-weight-normal" scope="col"><a href="{{ route("admin.$type.edit", $post->slug) }}">Изменить</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
