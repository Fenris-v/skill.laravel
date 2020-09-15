@extends('layout.layout')

@section('title', 'Создать статью')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">

                <h2>Создание поста</h2>

                <hr>

                @include('posts.post-form', ['action' => route('posts.store')])

            </div>

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
