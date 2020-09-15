@php($edit ?? $edit = false)

<form class="mb-2" action="{{ $action }}" method="POST">

    @switch(strtolower($method ?? ''))
        @case('patch')
            @method('PATCH')
            @break
        @default
            @method('POST')
    @endswitch

    @csrf

    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" class="form-control" id="title" value="{{ $edit ? old('title', $post->title) : old('title') }}"
               name="title" placeholder="Введите заголовок">
        @if($errors->first('title'))
            <div class="alert alert-danger mt-4">
                <p>{{ $errors->first('title') }}</p>
            </div>
        @endif
    </div>

    @if($edit)
        <div class="form-group">
            <label for="slug">Адрес</label>
            <input type="text" class="form-control" id="title" value="{{ $edit ? old('slug', $post->slug) : old('slug') }}"
                   name="slug" placeholder="Введите адрес">
            @if($errors->first('slug'))
                <div class="alert alert-danger mt-4">
                    <p>{{ $errors->first('slug') }}</p>
                </div>
            @endif
        </div>
    @endif

    <div class="form-group">
        <label for="short_desc">Короткое описание</label>
        <textarea class="form-control" id="short_desc" name="short_desc"
                  rows="3">{{ $edit ? old('short_desc', $post->short_desc) : old('short_desc') }}</textarea>
        @if($errors->first('short_desc'))
            <div class="alert alert-danger mt-4">
                <p>{{ $errors->first('short_desc') }}</p>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="htmlInput">Текст поста</label>
        <textarea class="form-control" id="htmlInput"
                  name="text" rows="3">{{ $edit ? old('text', $post->text) : old('text') }}</textarea>
        @if($errors->first('text'))
            <div class="alert alert-danger mt-4">
                <p>{{ $errors->first('text') }}</p>
            </div>
        @endif
    </div>
    <div class="form-group">
        @include('posts.edit-tags')
    </div>
    <div class="form-group form-check">
        <input
            @if ($edit)
                {{ old('published', $post->published) === 'on' ? 'checked' : '' }}
            @else
                {{ old('published') === 'on' ? 'checked' : '' }}
            @endif
            type="checkbox" class="form-check-input" id="published" name="published">
        <label class="form-check-label" for="published">Опубликовано</label>
    </div>
    <button type="submit" class="btn btn-primary">{{ $edit ? 'Изменить' : 'Создать' }}</button>
</form>
