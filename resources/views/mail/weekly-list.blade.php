@if(count($posts) > 0)
    <ol>
        @foreach($posts as $slug => $post)
            <li><a href="{{ route('posts.show', $slug) }}">{{ $post }}</a></li>
        @endforeach
    </ol>
@else
    <p>На этой неделе ничего не опубликовано :(</p>
@endif
