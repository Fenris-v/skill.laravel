@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')
    <form class="mb-2" action="{{ route('admin.news.store') }}" method="post">
        @include('posts.post-form', ['post' => new \App\Models\News(), 'type' => 'news'])

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
