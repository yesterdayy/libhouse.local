@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{ Form::open(['route' => 'register', 'enctype' => 'multipart/form-data']) }}
                        @csrf

                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="realty_type" value="1" autocomplete="off" checked> Хозяин
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="realty_type" value="2" autocomplete="off"> Риелтор
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="realty_type" value="3" autocomplete="off"> Застройщик
                            </label>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('name', 'ФИО', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('name', null, ['class' => 'form-control' . $errors->has('name') ? ' is-invalid' : '']) }}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('email', __('E-Mail Address'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::email('email', null, ['class' => 'form-control' . $errors->has('email') ? ' is-invalid' : '']) }}

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('phone', 'Номер телефона', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('phone', null, ['class' => 'form-control' . $errors->has('phone') ? ' is-invalid' : '']) }}

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password', __('Password'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password', null, ['class' => 'form-control' . $errors->has('password') ? ' is-invalid' : '']) }}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password-confirm', __('Confirm Password'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password_confirmation', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_address', 'Адрес', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_address', null, ['class' => 'form-control' . $errors->has('company_address') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_name', 'Название агентства', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_name', null, ['class' => 'form-control' . $errors->has('company_name') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_phone', 'Телефон компании', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_phone', null, ['class' => 'form-control' . $errors->has('company_phone') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_work_time', 'Рабочее время компании', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_work_time', null, ['class' => 'form-control' . $errors->has('company_work_time') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_work_time'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company_work_time') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_email', 'Email компании', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_email', null, ['class' => 'form-control' . $errors->has('company_email') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_vk', 'VK', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_vk', null, ['class' => 'form-control' . $errors->has('company_vk') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_vk'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_vk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_ok', 'OK', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_ok', null, ['class' => 'form-control' . $errors->has('company_ok') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_ok'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_ok') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_facebook', 'Facebook', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company_facebook', null, ['class' => 'form-control' . $errors->has('company_facebook') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company_facebook'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_document', 'Документы', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                <div class="dropzone-block dropzone-photo-upload" id="dropzoneupload" data-name="photos[]"></div>

                                @if ($errors->has('company_document'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company_logotip', 'Логотип', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                <div class="dropzone-block dropzone-photo-document-upload" data-name="documents[]"></div>

                                @if ($errors->has('company_logotip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_logotip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::submit(__('Register'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".dropzone-photo-upload").dropzone({
        url: "/upload/photo",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file) {
            let result = JSON.parse(file.xhr.response);
            let file_id = result.id;

            $(this.element).append('<input type="hidden" name="' + $(this.element).attr('data-name') + '" value="' + file_id + '" />');
        }
    });

    $(".dropzone-photo-document-upload").dropzone({
        url: "/upload/photo_document",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file) {
            let result = JSON.parse(file.xhr.response);
            let file_id = result.id;

            $(this.element).append('<input type="hidden" name="' + $(this.element).attr('data-name') + '" value="' + file_id + '" />');
        }
    });
</script>
@endsection
