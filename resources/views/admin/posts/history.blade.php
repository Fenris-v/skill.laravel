<h2>История изменений</h2>
@forelse($post->history()->get() as $item)
    <p>{{ $item->email }} - {{ $item->pivot->created_at }}</p>
    <h3>Было:</h3>
    <p>{!! $item->pivot->before['text'] ? $item->pivot->before['text'] : '' !!}</p>
    <h3>Стало:</h3>
    <p>{!! $item->pivot->after['text'] ? $item->pivot->after['text'] : '' !!}</p>
@empty
    <p>Нет изменений</p>
@endforelse
