@extends('index_no_sidebar')

@section('content')

    <div class="mx-auto" style="max-width: 500px">
        <div class="widget-title">{{ __('Reset Password') }}</div>

        @if ($is_valid_token)
            {{ Form::open(['route' => 'password.update', 'method' => 'post', 'class' => 'reset-password-submit-form']) }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    {{ Form::label(null, __('Password'), ['class' => 'm-light']) }}
                    {{ Form::password('password', ['class' => 'form-control', 'id' => null]) }}
                </div>

                <div class="form-group">
                    {{ Form::label(null, __('Confirm Password'), ['class' => 'm-light']) }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => null]) }}
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-block active mx-0">{{ __('Reset Password') }}</button>
                </div>
            {{ Form::close() }}
        @else
            <p>Данная заявка устарела или не существует.</p>
        @endif
    </div>
@endsection
