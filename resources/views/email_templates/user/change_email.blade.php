<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <p><b>{{ $user_name }}</b>, на ваш аккаунт была подана заявка на смену email. Если вы действительно этого хотите то перейдите по ссылке <a href="{{ route('user.set_email') }}?token={{ $token }}">{{ route('user.set_email') }}?token={{ $token }}</a></p>
</body>
</html>
