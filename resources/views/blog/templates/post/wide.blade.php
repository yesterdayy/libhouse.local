<article class="entry-post post-{{ (get_post_list_used_space() % 3 < 2 ? get_post_meta('thumb_type') : 'thumb') }}" data-place="{{ get_post_list_current_used_space() }}">
    <?= get_post_thumbnail((get_post_list_used_space() % 3 < 2 || get_post_list_used_space() == 0 ? get_post_meta('thumb_type') : 'thumb')) ?>
    <div class="entry-body entry-body-{{ get_post_meta('color') ?: 'default' }}">
        <div class="entry-title"><a href="{{ get_post_link() }}">{{ get_post_title() }}</a></div>

        <div class="entry-content">
            {!! (get_post_list_used_space() % 3 < 2 ? get_post_excerpt(480) : get_post_excerpt()) !!}
        </div>

        <div class="entry-footer">
            <div class="entry-date">
                <i class="icon icon-clock"></i> {{ get_post_locale_date() }}
            </div>

            <div class="attach-type-post">{!! get_post_attach_type() !!}</div>

            <div class="entry-counter"><i class="icon icon-eye"></i> {{ get_post_meta('counter') }}</div>
        </div>
    </div>
</article>