@extends('shortcodes.widget')

@if ($ajax)
    @section('widget-content')
        @if ($realtys)
            @each('/realty/list_realty', $realtys, 'realty')
        @endif
    @endsection
@else
    @section('widget-content')
        @if ($realtys)
            <div class="{{ $widget_class }} slick-single-silde row">
                @each('/realty/list_realty', $realtys, 'realty')
            </div>
        @else
            <p class="{{ $widget_class }}-ajax-load text-warning">Нет объявлений</p>
        @endif
    @endsection

    @section('after-widget')
        @if ($ajax_url && $realtys && $realtys->count() === $limit)
            <div class="{{ $widget_class }}-ajax-load text-danger">******* ЕЩЕ *******</div>
        @endif

        @if ($ajax_url)
            <script>
                var realty_list_widget_ajax_params = {
                    start: 0,
                    length: {{ $limit }},
                    author_id: {{ $author_id ?? 0 }}
                };

                $('.{{ $widget_class }}-ajax-load').click(function () {
                    realty_list_widget_ajax_params.start += realty_list_widget_ajax_params.length;
                    var that = this;

                    $.ajax({
                        type: 'POST',
                        url: '{{ $ajax_url }}',
                        data: realty_list_widget_ajax_params,
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

                $('.realty-photos').slick({
                    lazyLoad: 'ondemand',
                    arrows: false,
                    infinite: false,
                    dots: true,
                });
            </script>
        @endif
    @endsection
@endif
