<form action="{{ route("comment.store.$type", $slug) }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Оставить комментарий</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('text') }}</textarea>
    </div>

    <input name="commentable_type" type="text" class="d-none" value="{{ $class }}">

    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
