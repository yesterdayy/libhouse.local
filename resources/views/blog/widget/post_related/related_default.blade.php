<article class="entry-related">
    <?= get_post_thumbnail('thumb') ?>

    <div class="entry-related-body">
        <div class="entry-related-title">
            <a href="{{ get_post_link() }}">{{ get_post_title() }}</a>
        </div>

        <div class="entry-related-info">
            <div class="entry-related-date">
                <i class="icon icon-clock"></i> {{ get_post_locale_date() }}
            </div>

            <div class="entry-related-author">
                <img src="/upload/avatars/no_ava.jpg" />
                {{ get_post_author() }}
            </div>
        </div>
    </div>
</article>