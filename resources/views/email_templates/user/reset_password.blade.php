<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <p><b>{{ $user_name }}</b>, на ваш аккаунт была подана заявка на сброс пароля. Если вы действительно этого хотите то перейдите по ссылке <a href="{{ route('user.reset_password') }}/{{ $token }}">{{ route('user.reset_password') }}/{{ $token }}</a></p>
</body>
</html>
