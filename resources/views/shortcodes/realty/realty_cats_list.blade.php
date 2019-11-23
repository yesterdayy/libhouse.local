@extends('shortcodes.widget')

@section('widget-content')
    <div class="row" {!! $args !!}>
        <div class="col-md-6">
            <label>Жилая</label>
            <div class="d-table table mb-0">
                @foreach ($room_types as $room_type_item)
                    <div class="d-table-row">
                        @foreach ($room_type_item as $room_type)
                            @if (isset($room_type->id))
                                <a href="/{{ $room_type->slug }}" class="adv-cats-link d-table-cell">{{ $room_type->name }} {!! $shortcode_args['with-count'] ? '<span>' . $room_type->cnt . '</span>' : '' !!}</a>
                            @else
                                <div class="d-table-cell"></div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <label>Коммерческая</label>
            <div class="d-table table mb-0">
                @foreach ($types as $type_item)
                    <div class="d-table-row">
                        @foreach ($type_item as $type)
                            @if (isset($type->id))
                                <a href="/{{ $type->slug }}" class="adv-cats-link d-table-cell" data-id="{{ $type->id }}">{{ $type->name }} {!! $shortcode_args['with-count'] ? '<span>' . $type->cnt . '</span>' : '' !!}</a>
                            @else
                                <div class="d-table-cell"></div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
