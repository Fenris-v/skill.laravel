<div class="blog-post">
    <h2 class="blog-post-title"><a href="{{ route('postShow', ['post' => $post->getRouteKey()]) }}">{{ $post->title }}</a></h2>
    <p class="blog-post-meta">{{ $post->created_at->isoFormat('D MMM YYYY') }}</p>

    <p>{{ $post->short_desc }}</p>
</div>
