@component($typeForm,get_defined_vars())
    <div data-controller="fields--input"
         data-fields--input-mask="{{$mask ?? ''}}"
    >
        <div class="input-group">
            @if (isset($prepend))
                <div class="input-group-prepend">
                    <div class="input-group-text">{{ $prepend }}</div>
                </div>
            @endif

            <input @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
        </div>
    </div>
@endcomponent