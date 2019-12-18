@extends('shortcodes.widget')

@section('widget-content')
    @if ($realtys)
        <div class="{{ $widget_class }} slick-single-silde row" data-page="1">
            @each('/realty/templates/' . (isset($shortcode_args['template']) ? $shortcode_args['template'] : 'realty'), $realtys, 'realty')

            {{ $realtys->render() }}
        </div>
    @else
        <p class="{{ $widget_class }}-ajax-load text-warning">Нет объявлений</p>
    @endif
@endsection

@section('after-widget')
    <script>
        $('.realty-photos').slick({
            lazyLoad: 'ondemand',
            arrows: false,
            infinite: false,
            dots: true,
        });

        window.show_user_number = false;
        $('.show-user-number').click(function () {
            if (window.show_user_number) {
                return false;
            }

            window.show_user_number = true;

            var that = this;
            $.ajax({
                url: '/cabinet/phone?id=' + $(this).attr('data-id'),
                dataType: "json",
                success: function (result) {
                    if ('phone' in result) {
                        $(that).text(result.phone);
                        $(that).addClass('no-pointer');
                        $(that).off('click');
                    }
                }
            }).always(function() {
                window.show_user_number = false;
            });
        });
    </script>
@endsection
