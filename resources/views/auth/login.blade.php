
{{ Form::open(['route' => 'login', 'method' => 'post', 'class' => 'login-form']) }}
    <div class="form-group">
        {{ Form::label('email', 'Email', ['class' => 'm-light']) }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Пароль', ['class' => 'm-light']) }}
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>

    <div class="form-group row login-params no-gutters">
        <div class="col-md-6">
            {{ Form::checkbox('remember', null, null, ['id' => 'remember', 'class' => 'checkbox blue']) }}
            {{ Form::label('remember', __('Remember Me')) }}
        </div>

        <div class="col-md-6 text-right" style="margin-top: -1px">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="reset-pass">Забыли пароль ?</a>
            @endif
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-lg btn-block active mx-0">Войти</button>
    </div>

    <div class="form-group form-after-desc text-center">
        При входе, вы принимаете условия <a href="#">Пользовательского соглашения</a> и <a href="#">Политики конфиденциальности</a>
    </div>
{{ Form::close() }}
