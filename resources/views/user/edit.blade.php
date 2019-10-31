@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{ Form::model($user, ['route' => 'register', 'enctype' => 'multipart/form-data']) }}
                        @csrf

                        @if (!empty($realty_types))
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach ($realty_types as $realty_type)
                                    <label class="btn btn-secondary {{ $user->realty_type == $realty_type->id ? 'active' : '' }}">
                                        {{ Form::radio('realty_type', $realty_type->id, null, ['class' => 'form-control']) }} {{ $realty_type->name }}
                                    </label>
                                @endforeach
                            </div>
                        @endif

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
                            {{ Form::label('company[phone]', 'Номер телефона', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company[phone]', null, ['class' => 'form-control' . $errors->has('company[phone]') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company[phone]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company[phone]') }}</strong>
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
                            {{ Form::label('company[company_address]', 'Адрес', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company[company_address]', null, ['class' => 'form-control' . $errors->has('company[company_address]') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company[company_address]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company[company_address]') }}</strong>
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
                            {{ Form::label('company[work_time]', 'Рабочее время компании', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company[work_time]', null, ['class' => 'form-control' . $errors->has('company[work_time]') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company[work_time]'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company[work_time]') }}</strong>
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
                            {{ Form::label('company[vk]', 'VK', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company[vk]', null, ['class' => 'form-control' . $errors->has('company[vk]') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company[vk]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company[vk]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company[ok]', 'OK', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company[ok]', null, ['class' => 'form-control' . $errors->has('company[ok]') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company[ok]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company[ok]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('company[facebook]', 'Facebook', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('company[facebook]', null, ['class' => 'form-control' . $errors->has('company[facebook]') ? ' is-invalid' : '']) }}

                                @if ($errors->has('company[facebook]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company[facebook]') }}</strong>
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
                            {{ Form::label('company[logotip]', 'Логотип', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                <div class="dropzone-block dropzone-photo-document-upload" data-name="documents[]"></div>

                                @if ($errors->has('company[logotip]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company[logotip]') }}</strong>
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
