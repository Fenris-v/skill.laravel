@extends('layout.layout')

@section('title', $post->title)

@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $post->title }}
                        @can('update', $post)
                            <a class="btn-outline-primary btn"
                               href="@editPost($post->getRouteKey())">Изменить</a>
                        @endcan

                        @auth
                            @if(Auth::user()->isAdmin())
                                <a class="btn {{ $post->published ? 'btn-outline-danger' : 'btn-outline-secondary' }}"
                                   id="publishing"
                                   href="#">{{ $post->published ? 'Снять с публикации' : 'Опубликовать' }}</a>

                                <form id="publishing-form"
                                      action="{{ route('posts.publishing', $post->getRouteKey()) }}"
                                      method="POST"
                                      class="d-none">
                                    @csrf

                                    @if($post->published)
                                        @method('DELETE')
                                    @endif
                                </form>
                            @endif
                        @endauth
                    </h2>
                    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }}</p>

                    @include('posts.tags', ['tags' => $post->tags])

                    <div class="mb-3">
                        <div class="float-right w-50">
                            <img class="w-100 pl-2 pb-2" src="{{ $post->image ?? '' }}" alt="image">
                        </div>
                        {!! $post->text !!}
                    </div>
                    <a class="btn btn-primary" href="{{ route('posts.index') }}">Вернуться</a>
                </div>

                @auth
                    <form action="{{ route("comment.store.post", $post->slug) }}" method="POST">
                        @include('comments.create')
                    </form>
                @else
                    @include('comments.auth')
                @endauth

                @if($comments->count() > 0)
                    @include('comments.show', ['comments' => $comments])
                @endif
            </div>

            @include('layout.side')

        </div>

    </main>
@endsection
