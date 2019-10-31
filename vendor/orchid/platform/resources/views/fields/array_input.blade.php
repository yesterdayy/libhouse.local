@component($typeForm,get_defined_vars())
    <div data-controller="array-list-items fields--array-input" @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
        @if (isset($value))
            @foreach($value as $label => $item)
                <div class="form-group ml-3">
                    <label>{{ $label }}</label>
                    <input type="text" name="{{ $name }}[{{ $label }}]" class="form-control" value="{{ $item }}">
                </div>
            @endforeach
        @endif
    </div>
@endcomponent