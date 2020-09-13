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
                               href="{{ route('postEdit', ['post' => $post->getRouteKey()]) }}">Изменить</a>
                        @endcan

                        @if(\App\Models\User::isAdmin())
                            <a class="btn {{ $post->published ? 'btn-outline-danger' : 'btn-outline-secondary' }}"
                               id="publishing"
                               href="#">{{ $post->published ? 'Снять с публикации' : 'Опубликовать' }}</a>

                            <form id="publishing-form" action="{{ route('postPublishing', $post->getRouteKey()) }}" method="POST"
                                  class="d-none">
                                @csrf

                                @if($post->published)
                                    @method('DELETE')
                                @endif
                            </form>
                        @endif
                    </h2>
                    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }}</p>

                    @include('posts.tags', ['tags' => $post->tags])

                    {!! $post->text !!}
                    <a class="btn btn-primary" href="{{ route('mainPage') }}">Вернуться</a>
                </div>
            </div>

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
