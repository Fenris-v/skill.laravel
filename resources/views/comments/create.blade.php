@csrf

<div class="form-group">
    <label for="exampleFormControlTextarea1">Оставить комментарий</label>
    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('text') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">Отправить</button>
