<h2>Обратная связь</h2>
<hr>

<form action="{{ route('contacts') }}" method="post">

    @csrf

    <div class="form-group">
        <label for="email">Почта</label>
        <input value="{{ old('email') }}" type="text" class="form-control" id="email"
               name="email" placeholder="Введите почту">
        @if($errors->first('email'))
            <div class="alert alert-danger mt-4">
                <p>{{ $errors->first('email') }}</p>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="message">Сообщение</label>
        <textarea class="form-control" id="message" name="message" rows="3">{{ old('message') }}</textarea>
        @if($errors->first('message'))
            <div class="alert alert-danger mt-4">
                <p>{{ $errors->first('message') }}</p>
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
