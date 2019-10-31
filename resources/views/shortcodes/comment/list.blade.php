@if ($ajax)
    @if ($comments)
        @each('/shortcodes/comment/list_comment', $comments, 'comment');
    @endif
@else
    <div class="widget-block {{ $widget_class }}-wrap" {!! $shortcode_string_args !!}>
        <div class="widget-title {{ $widget_class }}-title">{{ $widget_title }}</div>
        <div class="{{ $widget_class }}-content d-inline-block w-100">
            @if ($comments)
                @each('/shortcodes/comment/list_comment', $comments, 'comment');
            @else
                <p class="{{ $widget_class }}-ajax-load text-warning">Нет коммнтариев</p>
            @endif
        </div>

        @if ($ajax_url && $comments && $comments->count() === $limit)
            <div class="{{ $widget_class }}-ajax-load text-danger">******* ЕЩЕ *******</div>
        @endif
    </div>

    @if ($ajax_url)
        <script>
            var comment_list_widget_ajax_params = {
                start: 0,
                length: {{ $limit }},
                author_id: {{ $author_id }}
            };

            $('.{{ $widget_class }}-ajax-load').click(function () {
                comment_list_widget_ajax_params.start += comment_list_widget_ajax_params.length;
                var that = this;

                $.ajax({
                    type: 'POST',
                    url: '{{ $ajax_url }}',
                    data: comment_list_widget_ajax_params,
                    success: function(result) {
                        if (result.length > 0) {
                            $(that).closest('.widget-block').find('.{{ $widget_class }}-content').append(result);
                        } else {
                            $(that).remove();
                        }
                    },
                    error: function (result) {
                    },
                });
            });
        </script>
    @endif
@endif
