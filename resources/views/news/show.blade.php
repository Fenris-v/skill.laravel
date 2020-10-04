@extends('layout.layout')

@section('title', $news->title)

@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $news->title }}</h2>
                    <p class="blog-post-meta">{{ $news->created_at->isoFormat('D MMM YYYY') }}</p>

                    @include('posts.tags', ['tags' => $news->tags])

                    <div class="mb-3">
                        {!! $news->text !!}
                    </div>
                    <a class="btn btn-primary" href="{{ route('news.index') }}">Вернуться</a>
                </div>

                @auth
                    @include('comments.create', ['type' => 'news', 'slug' => $news->slug, 'class' => App\Models\News::class])
                @else
                    <div class="text-secondary">
                        Авторизуйтесь, чтобы оставить комментарий
                    </div>
                @endauth

                @if($comments->count() > 0)
                    @include('comments.show', ['comments' => $comments])
                @endif
            </div>

            @include('layout.side')

        </div>

    </main>
@endsection
