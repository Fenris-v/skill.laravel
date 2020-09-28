<div class="blog-post">
    <h2 class="blog-post-title"><a
            href="{{ route('posts.show', ['post' => $post->getRouteKey()]) }}">{{ $post->title }}</a></h2>
    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }} by
        <a href="{{ route('posts.by.user', $post->user->name) }}"
           class="badge badge-success">{{ $post->user->name }}</a>
    </p>

    @include('posts.tags', ['tags' => $post->tags])

    <div>
        <img class="w-25 {{ $key % 2 === 1 ? 'float-left mr-3' : 'float-right ml-3' }}"
             src="{{ $post->image ?? '' }}" alt="image">
        <p class="text-justify">{{ $post->short_desc }}</p>
    </div>
</div>
