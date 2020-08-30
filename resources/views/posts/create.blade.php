@extends('layout.layout')

@section('title', 'Создать статью')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">

                <h2>Создание поста</h2>

                <hr>

                <form action="/" method="post">

                    @csrf

                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                               name="title" placeholder="Введите заголовок">
                        @if($errors->first('title'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('title') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Короткое описание</label>
                        <textarea class="form-control" id="short_desc" name="short_desc"
                                  rows="3">{{ old('short_desc') }}</textarea>
                        @if($errors->first('short_desc'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('short_desc') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="htmlInput">Текст поста</label>
                        <textarea class="form-control" id="htmlInput" name="text" rows="3">{{ old('text') }}</textarea>
                        @if($errors->first('text'))
                            <div class="alert alert-danger mt-4">
                                <p>{{ $errors->first('text') }}</p>
                            </div>
                        @endif
                    </div>
                    @if(\App\User::isAdmin())
                        <div class="form-group form-check">
                            <input {{ old('published') === 'on' ? 'checked' : '' }}
                                   type="checkbox" class="form-check-input" id="published" name="published">
                            <label class="form-check-label" for="published">Опубликовать</label>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
