@extends('shortcodes/widget')

@section('widget-content')
    <div class="cats-list-wrap" {!! $args !!}>
        <ul class="cats-list">
            @foreach ($cats as $cat)
                <li data-id="{{ $cat->id }}">{{ $cat->name }} {{ $cat->cnt ? '(' . $cat->cnt . ')' : '' }}</li>
            @endforeach
        </ul>
    </div>
@endsection
