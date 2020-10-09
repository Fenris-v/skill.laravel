@extends('layout.layout')

@section('title', 'Создать статью')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">

                <h2>Изменение поста</h2>

                <hr>

                <form class="mb-2" action="{{ route('posts.update', $post->getRouteKey()) }}" method="POST">
                    @method('PATCH')
                    @include('posts.post-form', ['canEditSlug' => true])

                    <button type="submit" class="btn btn-primary">Изменить</button>
                </form>

                <form class="mb-2" action="{{ route('posts.destroy', $post->getRouteKey()) }}" method="POST">

                    @method('DELETE')

                    @csrf

                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>

            @include('layout.side')

        </div>

    </main>
@endsection
