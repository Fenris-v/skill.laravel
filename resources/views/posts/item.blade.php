@switch($post->getTable())
    @case('news')
        @php($route = 'news.show')
        @break
    @default
        @php($route = 'posts.show')
@endswitch

<div class="blog-post">
    <h2 class="blog-post-title"><a
            href="{{ route($route, $post->slug) }}">{{ $post->title }}</a></h2>
    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }}
        @if($post->user)
            by <a href="{{ route('posts.by.user', $post->user->name) }}"
                  class="badge badge-success">{{ $post->user->name }}</a>
        @endif
    </p>

    @include('posts.tags', ['tags' => $post->tags])

    <div>
        @if($post->image)
            <img class="w-25 {{ $key % 2 === 1 ? 'float-left mr-3' : 'float-right ml-3' }}"
                 src="{{ $post->image }}" alt="image">
        @endif
        <p class="text-justify">{{ $post->short_desc }}</p>
    </div>
</div>
