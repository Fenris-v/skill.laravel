<div class="col-md-8 blog-main">

    <h3 class="pb-4 mb-4 font-italic border-bottom">
        Список постов
    </h3>

    @each('posts.item', $items, 'post')

{{--    {{ $items->onEachSide(1)->links() }}--}}

</div>
