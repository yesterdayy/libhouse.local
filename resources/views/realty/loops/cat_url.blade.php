@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    <div class="realty-breadcrumbs-wrap-alt">
        {!! get_breadcrumbs($breadcrumbs) !!}
    </div>

    <h1 class="widget-title realty-cats-title" style="margin: 10px 0 40px 0;">{{ $page_title }}</h1>

    @if ($realtys)
        <div class="cat-url-widget slick-single-silde row" data-page="1">
            @each('/realty/templates/' . (isset($shortcode_args['template']) ? $shortcode_args['template'] : 'realty'), $realtys, 'realty')

            {{ $realtys->render() }}
        </div>
    @else
        <p class="{{ $widget_class }}-ajax-load text-warning">Нет объявлений</p>
    @endif
@endsection
