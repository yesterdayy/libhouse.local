@while (loop_posts_derkach($used_space))
    @include($template['cat'] . '.'.get_post_template($template['default_post_template']))
@endwhile