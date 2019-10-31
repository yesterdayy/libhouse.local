@foreach ($attributes as $name => $value)
    @if(is_bool($value))
        {{$name}}
    @elseif(is_array($value))
        @if ($name != 'classes')
            @json($value)
        @endif
    @else
        {{$name}}="{{$value}}"
    @endif
@endforeach
