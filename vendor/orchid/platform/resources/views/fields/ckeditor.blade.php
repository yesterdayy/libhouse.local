@component($typeForm,get_defined_vars())
    <div data-controller="fields--ckeditor" data-theme="{{$theme ?? 'inlite'}}">
        <textarea class="ckeditor b wrapper" id="ckeditor-wrapper-{{$id}}" style="min-height: {{ $attributes['height'] }}">
            {!! $value !!}
        </textarea>
        <input type="hidden" @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
    </div>
@endcomponent