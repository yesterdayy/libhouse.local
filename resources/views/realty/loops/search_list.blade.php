@extends('shortcodes.widget')

@section('before-widget')
    @include('realty.components.pick_filters', compact('pick_filters', 'realtys', 'sort_variants'))
@endsection

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
    </script>
@endsection
