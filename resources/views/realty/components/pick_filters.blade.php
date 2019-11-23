<div class="pick-filter @if (count($pick_filters) == 0) no-filters @endif">
    @if (count($pick_filters) > 0)
        @foreach ($pick_filters as $field => $pick_filter)

            @if (is_array($pick_filter))
                @foreach ($pick_filter as $pfilter)
                    <div class="btn btn-gray btn-small" data-type="multiple" data-field="{{ $field }}" data-value="{{ $pfilter['id'] }}">{{ $pfilter['val'] }} <i class="lh-icon lh-icon-cross remove-filter"></i></div>
                @endforeach
            @else
                <div class="btn btn-gray btn-small" data-field="{{ $field }}">{{ $pick_filter }} <i class="lh-icon lh-icon-cross remove-filter"></i></div>
            @endif

        @endforeach
    @endif

    <div class="filter-sort-wrap float-right">
        {{ $realtys->total() }} предложений отсортированы <span class="filter-sort text-primary">{{ $sort_variants[$sort_by] }} <i class="lh-icon lh-icon-select-arrow"></i></span>

        <div class="filter-sort-pick-popover d-none">
            <ul class="header-filter-simple-list custom-event filter-sort-pick">
                @foreach ($sort_variants as $sort_key => $sort_value)
                    <li data-val="{{ $sort_key }}">{{ $sort_value }}</li>
                @endforeach
            </ul>
        </div>

        <script>
            $('.filter-sort').popover({
                content: $('.filter-sort-pick-popover ul')[0],
                container: '.pick-filter',
                html: true,
                placement: 'bottom',
                offset: '-67px 5px',
                sanitize: false,
            });
        </script>
    </div>
</div>
