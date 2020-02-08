<div class="form-group">
    {{ Form::label(null, 'Имя') }}
    {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'id' => null]) }}
</div>

<div class="form-group">
    {{ Form::label(null, 'Фамилия') }}
    {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'id' => null]) }}
</div>

<div class="form-group">
    {{ Form::label(null, 'Дата рождения') }}
    {{ Form::text('birthdate', $user->middle_name, ['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker-birthdate', 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker-birthdate']) }}
</div>

<div class="form-group">
    <button class="btn btn-lg active cabinet-save-form mx-0">Сохранить</button>
</div>

<script>
    $('.datetimepicker-input').datetimepicker({
        locale: 'ru',
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'top',
        },
        format: 'DD.MM.YYYY'
    });
</script>
