@component($typeForm,get_defined_vars())
    <div data-controller="fields--avatar-upload"
         data-fields--avatar-upload-image="{{$attributes['value']}}"
         data-fields--avatar-upload-storage="{{$storage ?? 'public'}}"
         data-fields--avatar-upload-width="{{$width}}"
         data-fields--avatar-upload-height="{{$height}}">
        <div class="b text-right wrapper picture-actions" style="height: 186px; padding: 17px;">

            <div class="fields--avatar-upload--container text-left" style="display: inline-block; float: left; width: 150px; margin-right: 20px;">
                <img src="#" class="picture-preview img-fluid m-b-md b" alt="">
            </div>

            <span class="mt-1 float-left">{{ __('Upload image from your computer:') }}</span>

            <label class="btn btn-default m-n">
                <i class="icon-cloud-upload"></i> {{ __('Browse') }}
                <input type="file"
                       accept="image/*"
                       data-target="fields--avatar-upload.upload"
                       data-action="change->fields--avatar-upload#upload click->fields--avatar-upload"
                       class="d-none">
            </label>

            <button type="button" class="btn btn-outline-danger picture-remove"
                    data-action="fields--avatar-upload#clear">{{ __('Remove') }}</button>

            <input type="file" class="d-none">
        </div>

        <input class="picture-path"
               type="hidden"
               data-target="fields--avatar-upload.source"
                @include('platform::partials.fields.attributes', ['attributes' => $attributes])
        >

        <img class="d-none upload-panel">
    </div>
@endcomponent