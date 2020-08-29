@extends('layout.layout')

@section('title', 'Создать статью')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">

                <h2>Изменение поста</h2>

                <hr>

                <form class="mb-2" action="/posts/{{ $post->getRouteKey() }}" method="POST">

                    @method('PATCH')

                    @csrf

                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title') ?? $post->title }}"
                               name="title" placeholder="Введите заголовок">
                        @if($errors->first('title'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('title') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="slug">Адрес</label>
                        <input type="text" class="form-control" id="title" value="{{ old('slug') ?? $post->slug }}"
                               name="slug" placeholder="Введите адрес">
                        @if($errors->first('slug'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('slug') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Короткое описание</label>
                        <textarea class="form-control" id="short_desc" name="short_desc"
                                  rows="3">{{ old('short_desc') ?? $post->short_desc }}</textarea>
                        @if($errors->first('short_desc'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('short_desc') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="text">Текст поста</label>
                        <textarea class="form-control" id="text"
                                  name="text" rows="3">{{ old('text') ?? $post->text }}</textarea>
                        @if($errors->first('text'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('text') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input {{ old('published') === 'on' ? 'checked' : '' }} {{ $post->published ? 'checked' : '' }}
                               type="checkbox" class="form-check-input" id="published" name="published">
                        <label class="form-check-label" for="published">Опубликовано</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </form>

                <form action="/posts/{{ $post->getRouteKey() }}" method="POST">

                    @method('DELETE')

                    @csrf

                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
