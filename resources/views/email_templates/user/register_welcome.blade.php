<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <p>Спасибо за регистрацию.</p>
    <p><b>Ваш email: </b> {{ $user->email }}</p>
    <p><b>Ваш номер телефона: </b> {{ '+7' . substr(phone($user->phone, 'RU', \libphonenumber\PhoneNumberFormat::NATIONAL), 1) }}</p>
</body>
</html>
