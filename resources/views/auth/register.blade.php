{{ Form::open(['route' => 'register', 'method' => 'post', 'class' => 'register-form']) }}
    <div class="form-group">
        {!! Form::rawLabel('email', 'Email<span>*</span>', ['class' => 'm-light']) !!}
        {{ Form::email('email', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {!! Form::rawLabel('password', 'Пароль<span>*</span>', ['class' => 'm-light']) !!}
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {!! Form::rawLabel('phone', 'Телефон<span>*</span>', ['class' => 'm-light']) !!}
        {{ Form::text('phone', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group row login-params no-gutters">
        <div class="col-md-12">
            {{ Form::checkbox('realtor', null, null, ['id' => 'realtor', 'class' => 'checkbox blue']) }}
            {{ Form::label('realtor', 'Я агент') }}
        </div>
    </div>

    <div class="form-group row login-params no-gutters">
        <div class="col-md-12">
            {{ Form::checkbox('subscribe', null, null, ['id' => 'subscribe', 'class' => 'checkbox blue']) }}
            {{ Form::label('subscribe', 'Хочу получать новости от ' . strtolower($_SERVER['HTTP_HOST'])) }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-lg btn-block active mx-0">Зарегистрироваться</button>
    </div>

    <div class="form-group form-after-desc text-center">
        При входе, вы принимаете условия <a href="#">Пользовательского соглашения</a> и <a href="#">Политики конфиденциальности</a>
    </div>
{{ Form::close() }}
