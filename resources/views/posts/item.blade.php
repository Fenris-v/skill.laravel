<div class="blog-post">
    <h2 class="blog-post-title"><a
            href="{{ route('postShow', ['post' => $post->getRouteKey()]) }}">{{ $post->title }}</a></h2>
    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }} by
        <a href="{{ route('postsByUser', $post->user->name) }}" class="badge badge-success">{{ $post->user->name }}</a>
    </p>

    @include('posts.tags', ['tags' => $post->tags])

    <p>{{ $post->short_desc }}</p>
</div>
