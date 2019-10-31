@component($typeForm,get_defined_vars())
    <div data-controller="fields--picture-upload"
         data-fields--picture-upload-image="{{$attributes['value']}}"
         data-fields--picture-upload-storage="{{$storage ?? 'public'}}"
         data-fields--picture-upload-width="{{$width}}"
         data-fields--picture-upload-height="{{$height}}">
        <div class="b text-right wrapper picture-actions">

            <div class="fields--picture-upload--container">
                <a href="#" class="picture-preview-link" data-toggle="lightbox">
                    <img src="#" class="picture-preview img-fluid img-full m-b-md b" alt="">
                </a>
            </div>

            <span class="mt-1 float-left">{{ __('Upload image from your computer:') }}</span>

            <label class="btn btn-default m-n">
                <i class="icon-cloud-upload"></i> {{ __('Browse') }}
                <input type="file"
                       accept="image/*"
                       data-target="fields--picture-upload.upload"
                       data-action="change->fields--picture-upload#upload click->fields--picture-upload"
                       class="d-none">
            </label>

            <button type="button" class="btn btn-outline-danger picture-remove"
                    data-action="fields--picture-upload#clear">{{ __('Remove') }}</button>

            <input type="file" class="d-none">
        </div>

        <input class="picture-path"
               type="hidden"
               data-target="fields--picture-upload.source"
                @include('platform::partials.fields.attributes', ['attributes' => $attributes])
        >

        <img class="d-none upload-panel">
    </div>
@endcomponent