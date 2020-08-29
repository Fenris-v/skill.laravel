@extends('layout.layout')

@section('title', $post->title)

@section('content')

    @include('main.top')

    <main role="main" class="container">
        <div class="row">

            <div class="col-md-8 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $post->title }} <a class="h5"
                            href="{{ route('postEdit', ['post' => $post->getRouteKey()]) }}">Изменить</a></h2>
                    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }}</p>

                    {!! $post->text !!}
                    <a class="btn btn-primary" href="{{ route('mainPage') }}">Вернуться</a>
                </div>
            </div>

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
