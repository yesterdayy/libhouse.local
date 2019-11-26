{{ Form::open(['route' => 'password.email', 'method' => 'post', 'class' => 'reset-password-form']) }}
    <div class="form-group">
        <div class="auth-form-title">Восстановление пароля</div>
        <div class="auth-form-desc">На вашу электронную почту будет отправлена инструкция по восстановлению пароля.</div>
        {{ Form::label('email', 'Email', ['class' => 'm-light']) }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <button class="btn btn-lg btn-block active" style="margin: 20px 0 0 0;">Отправить</button>
    </div>
{{ Form::close() }}
