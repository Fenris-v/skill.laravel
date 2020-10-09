@switch($item->getTable())
    @case('news')
        @php($route = 'news.show')
        @break
    @default
        @php($route = 'posts.show')
@endswitch

<div class="blog-post">
    <h2 class="blog-post-title"><a
            href="{{ route($route, $item->slug) }}">{{ $item->title }}</a></h2>
    <p class="blog-post-meta">{{ $item->created_at->isoFormat('D MMM YYYY') }}
        @if($item->user)
            by <a href="{{ route('posts.by.user', $item->user->name) }}"
                  class="badge badge-success">{{ $item->user->name }}</a>
        @endif
    </p>

    @include('posts.tags', ['tags' => $item->tags])

    <div>
        @if($item->image)
            <img class="w-25 {{ $key % 2 === 1 ? 'float-left mr-3' : 'float-right ml-3' }}"
                 src="{{ $item->image }}" alt="image">
        @endif
        <p class="text-justify">{{ $item->short_desc }}</p>
    </div>
</div>
