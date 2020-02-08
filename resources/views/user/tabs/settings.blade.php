{{ Html::script('plugins/datetimepicker/tempusdominus-bootstrap-4.min.js') }}
{{ Html::style('plugins/datetimepicker/tempusdominus-bootstrap-4.min.css') }}

<div class="cabinet-settings-wrap row">
    <div class="col-md-8 cabinet-left-wrap">
        <div class="cabinet-col-1">
            <div class="cabinet-ava"><img src="/img/no_ava.jpg" width="64px" height="64px" /></div>
            <div class="cabinet-name">{{ $user->last_name }} {{ $user->first_name }}</div>
        </div>

        <div class="cabinet-col-2">
            <div class="cabinet-user-info">
                <div class="row">
                    <div class="cabinet-info-col-1">Тип аккаунта</div>
                    <div class="cabinet-info-col-2">Ваш номер ID</div>
                </div>

                <div class="row">
                    <div class="cabinet-info-col-1">{{ $user->realty_type->name }}</div>
                    <div class="cabinet-info-col-2">{{ $user->id }}</div>
                </div>
            </div>
        </div>

        <div class="cabinet-clear-col"></div>

        <div class="cabinet-col-1">
            {{ Form::open(['route' => 'user.set_fib', 'method' => 'post', 'class' => 'fib-form']) }}
                @include('user.settings_form')
            {{ Form::close() }}
        </div>

        <div class="cabinet-col-2">
            {{ Form::open(['route' => 'user.set_password', 'method' => 'post', 'class' => 'pass-form']) }}
                @include('user.settings_password_form')
            {{ Form::close() }}
        </div>
    </div>

    <div class="col-md-4 cabinet-right-wrap">
        <div class="cabinet-dop-change cabinet-phone">
            <p>Номер телефона</p>

            <div class="cabinet-change-view">
                <p>{{ '+7' . substr(phone($user->phone, 'RU', \libphonenumber\PhoneNumberFormat::NATIONAL), 1) }}</p>
                <div class="cabinet-change-link">Сменить номер телефона</div>
            </div>

            <div class="cabinet-change-edit d-none">
                {{ Form::text('phone', $user->phone, ['class' => 'form-control', 'id' => null]) }}
                <div class="cabinet-edit-link">Подтвердить номер</div>
            </div>
        </div>

        <div class="cabinet-dop-change cabinet-email">
            <p>Электронная почта</p>

            <div class="cabinet-change-view">
                <p>{{ $user->email }}</p>
                <div class="cabinet-change-link">Сменить электронную почту</div>
            </div>

            <div class="cabinet-change-edit d-none">
                {{ Form::text('email', $user->email, ['class' => 'form-control', 'id' => null]) }}
                <div class="cabinet-edit-link">Отправить ссылку для подтверждения</div>
            </div>
        </div>

        <script>
            $('.cabinet-change-link').click(function () {
                var elem_link = $(this).closest('.cabinet-dop-change').find('.cabinet-change-view');
                var elem_edit = $(this).closest('.cabinet-dop-change').find('.cabinet-change-edit');

                if (elem_edit.hasClass('d-none')) {
                    elem_link.addClass('d-none');
                    elem_edit.removeClass('d-none');
                } else {
                    elem_link.removeClass('d-none');
                    elem_edit.addClass('d-none');
                }
            });

            // Редактирование ФИО и даты рождения
            $('.fib-form').submit(function(e) {
                e.preventDefault();

                if (window.cabinet_fio_change_ajax) {
                    return false;
                }

                window.cabinet_fio_change_ajax = true;
                var that = this;

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        show_toast(result);
                    },
                    error: function (err) {
                        if ('status' in err.responseJSON && 'message' in err.responseJSON) {
                            show_toast(err.responseJSON);
                        } else {
                            validation_toast(err);
                        }
                    },
                }).always(function () {
                    window.cabinet_fio_change_ajax = false;
                });
            });

            // Редактирование пароля
            $('.pass-form').submit(function(e) {
                e.preventDefault();

                if (window.cabinet_password_change_ajax) {
                    return false;
                }

                window.cabinet_password_change_ajax = true;
                var that = this;

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        if (result.status == 'success') {
                            $('.change-pass-btn', that).click()
                        }
                        show_toast(result);
                    },
                    error: function (err) {
                        if ('status' in err.responseJSON && 'message' in err.responseJSON) {
                            show_toast(err.responseJSON);
                        } else {
                            validation_toast(err);
                        }
                    },
                }).always(function () {
                    window.cabinet_password_change_ajax = false;
                });
            });

            // Редактирование номера телефона
            $('.cabinet-phone .cabinet-edit-link').click(function() {
                if (window.cabinet_phone_change_ajax) {
                    return false;
                }

                window.cabinet_phone_change_ajax = true;
                var that = this;

                $.ajax({
                    type: 'POST',
                    url: '/cabinet/phone',
                    data: {
                        phone: $(this).prev().val()
                    },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        show_toast(result);

                        let elem_link = $(that).closest('.cabinet-dop-change').find('.cabinet-change-view');
                        let elem_edit = $(that).closest('.cabinet-dop-change').find('.cabinet-change-edit');

                        elem_link.removeClass('d-none');
                        elem_edit.addClass('d-none');
                    },
                    error: function (err) {
                        if ('status' in err.responseJSON && 'message' in err.responseJSON) {
                            show_toast(err.responseJSON);
                        } else {
                            validation_toast(err);
                        }
                    },
                }).always(function () {
                    window.cabinet_phone_change_ajax = false;
                });
            });

            // Редактирование почты
            $('.cabinet-email .cabinet-edit-link').click(function() {
                if (window.cabinet_email_change_ajax) {
                    return false;
                }

                window.cabinet_email_change_ajax = true;
                var that = this;

                $.ajax({
                    type: 'POST',
                    url: '/cabinet/change_email',
                    data: {
                        new_email: $(this).prev().val()
                    },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        show_toast(result);

                        let elem_link = $(that).closest('.cabinet-dop-change').find('.cabinet-change-view');
                        let elem_edit = $(that).closest('.cabinet-dop-change').find('.cabinet-change-edit');

                        elem_link.removeClass('d-none');
                        elem_edit.addClass('d-none');
                    },
                    error: function (err) {
                        if ('status' in err.responseJSON && 'message' in err.responseJSON) {
                            show_toast(err.responseJSON);
                        } else {
                            validation_toast(err);
                        }
                    },
                }).always(function () {
                    window.cabinet_email_change_ajax = false;
                });
            });
        </script>
    </div>
</div>
