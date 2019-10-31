<div class="comments">
    <div class="comments-title"><span>{{ $comments_count }}</span>Комментария</div>

    @include('comment.add')

    <div class="comments-list"></div>

</div>

<script>
    try {
        const comment_entry_id = {{ $shortcode_args['id'] }};
        get_comments_listener('{{ $shortcode_args['type'] }}');
        reply_comment_listener();
        add_comment_listener('{{ $shortcode_args['type'] }}');
    } catch (e) {
        console.error(e);
    }
</script>
