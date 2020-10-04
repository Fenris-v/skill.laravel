@extends('layout.layout')

@section('title', 'Создать статью')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">

                <h2>Создание поста</h2>

                <hr>

                <form action="{{ route('posts.store') }}" method="post">
                    @include('posts.post-form', ['post' => new \App\Models\Post()])

                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>

            </div>

            @include('layout.side')

        </div>

    </main>
@endsection
