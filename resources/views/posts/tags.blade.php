@php($tags = $tags ?? collect())

@if($tags->isNotEmpty())
    <div class="d-flex flex-wrap mb-3">
        @foreach($tags as $tag)
            <a href="{{ route('posts.tag', $tag->getRouteKey()) }}"
               class="mr-1 mb-2 p-1 badge badge-info text-white">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
