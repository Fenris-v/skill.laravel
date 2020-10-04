@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    @if(url()->current() === route('admin.news.edit', $post->slug ?? ''))
        @php($type = 'news')
    @else
        @php($type = 'posts')
    @endif

    <form class="mb-2" action="{{ route("$type.update", $post->getRouteKey()) }}" method="POST">
        @method('PATCH')
        @include('posts.post-form', ['canEditSlug' => true])

        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>

    <form class="mb-2" action="{{ route("$type.destroy", $post->getRouteKey()) }}" method="POST">

        @method('DELETE')

        @csrf

        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>

    <h2>История изменений</h2>
    @forelse($post->history()->get() as $item)
        <p>{{ $item->email }} - {{ $item->pivot->created_at }}</p>
        <h3>Было:</h3>
        <p>{!! $item->pivot->before ? json_decode($item->pivot->before)->text : '' !!}</p>
        <h3>Стало:</h3>
        <p>{!! $item->pivot->after ? json_decode($item->pivot->after)->text : '' !!}</p>
    @empty
        <p>Нет изменений</p>
    @endforelse

@endsection
