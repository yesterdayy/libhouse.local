<div class="post-list-wrap" data-limit="{{ $limit }}" data-page="{{ $page }}" data-sort="{{ isset($shortcode_args['sort-by']) ? $shortcode_args['sort-by'] : 'date' }}" data-unique-id="{{ $unique_id }}" {!! $args !!}>
    @if (isset($shortcode_args) && isset($shortcode_args['sort-buttons']) && toBoolean($shortcode_args['sort-buttons']))
        <ul class="post-list-sort right">
            <li class="btn{{ isset($shortcode_args['sort-by']) && $shortcode_args['sort-by'] == 'popular' ? ' active' : '' }}" data-value="popular"><i class="icon icon-star"></i> По популярности</li>
            <li class="btn{{ isset($shortcode_args['sort-by']) && $shortcode_args['sort-by'] == 'date' || !isset($shortcode_args['sort-by']) ? ' active' : '' }}" data-value="date"><i class="icon icon-clock"></i> По дате</li>
        </ul>
    @endif

    <div class="post-list">
        @include('blog.post_loop')
    </div>

    @if ($is_paginate)
        <div class="post-pagination-wrap">
            <div class="post-list-more btn">Загрузить ещё</div>
        </div>
    @endif
</div>

@if (isset($shortcode_args['data-masonry-posts']) && $shortcode_args['data-masonry-posts'])
    <script>
        $(function () {
            post_masonry('{{ $unique_id }}');
        });
    </script>
@endif