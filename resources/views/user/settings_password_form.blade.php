{{ Form::label(null, '&nbsp;') }}

<div class="cabinet-change-password">
    <div class="change-pass-btn"><span>Сменить пароль</span><i class="lh-icon lh-icon-select-arrow"></i></div>

    <div class="cabinet-change-password-edit d-none">
        <div class="form-group">
            {{ Form::label(null, 'Старый пароль') }}
            {{ Form::password('old_password', ['class' => 'form-control', 'id' => null]) }}
        </div>

        <div class="form-group">
            {{ Form::label(null, 'Новый пароль') }}
            {{ Form::password('new_password', ['class' => 'form-control', 'id' => null]) }}
        </div>

        <div class="form-group">
            <button class="btn btn-lg active cabinet-save-form mx-0">Сохранить</button>
        </div>
    </div>
</div>

<script>
    $('.change-pass-btn').click(function () {
        $(this).parent().find('.cabinet-change-password-edit').toggleClass('d-none');
    });
</script>
