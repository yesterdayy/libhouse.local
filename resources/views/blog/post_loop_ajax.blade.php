@while (loop_posts_derkach($used_space))
    @include($template_cat . '.templates.post_'.get_post_template())
@endwhile