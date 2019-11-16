@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    <div class="pick-filter">
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
    </div>

    [realty-list widget_title="false" type="search" paginated="1"]
@endsection
