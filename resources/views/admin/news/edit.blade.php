@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    <form class="mb-2" action="{{ route("news.update", $news->getRouteKey()) }}" method="POST">
        @method('PATCH')
        @include('posts.post-form', ['canEditSlug' => true, 'post' => $news])

        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>

    <form class="mb-2" action="{{ route("news.destroy", $news->getRouteKey()) }}" method="POST">

        @method('DELETE')

        @csrf

        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>
    
@endsection
