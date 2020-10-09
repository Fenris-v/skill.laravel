@php
    $canEditSlug = $canEditSlug ?? false;
    $type = $type ?? '';
@endphp

@csrf

<div class="form-group">
    <label for="title">Заголовок</label>
    <input type="text" class="form-control" id="title" value="{{ old('title', $post->title) }}"
           name="title" placeholder="Введите заголовок">
    @if($errors->first('title'))
        <div class="alert alert-danger mt-4">
            <p>{{ $errors->first('title') }}</p>
        </div>
    @endif
</div>

@if($canEditSlug)
    <div class="form-group">
        <label for="slug">Адрес</label>
        <input type="text" class="form-control" id="title" value="{{ old('slug', $post->slug) }}"
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
              rows="3">{{ old('short_desc', $post->short_desc) }}</textarea>
    @if($errors->first('short_desc'))
        <div class="alert alert-danger mt-4">
            <p>{{ $errors->first('short_desc') }}</p>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="htmlInput">Текст поста</label>
    <textarea class="form-control" id="htmlInput"
              name="text" rows="3">{{ old('text', $post->text) }}</textarea>
    @if($errors->first('text'))
        <div class="alert alert-danger mt-4">
            <p>{{ $errors->first('text') }}</p>
        </div>
    @endif
</div>
<div class="form-group">
    @include('posts.edit-tags')
</div>
@if($post instanceof App\Models\Post)
    <div class="form-group form-check">
        <input
            @if (old('published') === 'on' || (!old('published') && $post->published))
            checked
            @endif
            type="checkbox" class="form-check-input" id="published" name="published">
        <label class="form-check-label" for="published">Опубликовано</label>
    </div>
@endif
