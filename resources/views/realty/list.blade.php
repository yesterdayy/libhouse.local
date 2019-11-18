@extends('shortcodes.widget')

@section('before-widget')
    <div class="pick-filter @if (count($pick_filters) == 0) no-filters @endif">
        @if (count($pick_filters) > 0)
            @foreach ($pick_filters as $pick_filter)

                @if (is_array($pick_filter))
                    @foreach ($pick_filter as $pfilter)
                        <div class="btn btn-gray btn-small">{{ $pfilter }}</div>
                    @endforeach
                @else
                    <div class="btn btn-gray btn-small">{{ $pick_filter }}</div>
                @endif

            @endforeach
        @endif

        <div class="filter-sort-wrap float-right">
            {{ $paginator->total() }} предложений отсортированы <span class="filter-sort text-primary">по умолчанию <i class="lh-icon lh-icon-select-arrow"></i></span>
            <div class="filter-sort-pick d-none">
                <ul class="header-filter-simple-list">
                    <li data-val="">По умолчанию</li>
                    <li data-val="price_asc">По цене (сначала дешевле)</li>
                    <li data-val="price_desc">По цене (сначала дороже)</li>
                    <li data-val="square_desc">По общей площади</li>
                </ul>
            </div>
        </div>

        <script>
            $('.filter-sort').popover({
                content: $('.filter-sort-pick ul')[0],
                container: '.pick-filter',
                html: true,
                placement: 'bottom',
                offset: '-67px 5px',
                sanitize: false,
            });
        </script>
    </div>
@endsection

@section('widget-content')
    @if ($realtys)
        <div class="{{ $widget_class }} slick-single-silde row" data-page="1">
            @each('/realty/list_realty', $realtys, 'realty')

            {{ $paginator }}
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

    @if (isset($ajax_url) && $realtys && $realtys->count() === $limit)
        <div class="{{ $widget_class }}-ajax-load text-danger">******* ЕЩЕ *******</div>
    @endif

    @if (isset($ajax_url))
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
        </script>
    @endif
@endsection
