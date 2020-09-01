@php($tags = $tags ?? collect())

@if($tags->isNotEmpty())
    <div class="d-flex flex-wrap mb-3">
        @foreach($tags as $tag)
            <a href="{{ route('postsByTag', $tag->getRouteKey()) }}" class="mr-1 mb-2 badge badge-info">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
