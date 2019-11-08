@csrf

{{ var_dump($errors) }}

{{ Html::script('js/edit.js') }}

<div class="realty-create-form-block">
    <div class="form-group row">
        {!! Form::rawLabel('user_realty_type', 'Тип аккаунта<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($user_realty_types as $user_realty_type)
                <div class="@if ($loop->first) active @endif @if ($user_realty_type->status == 0) btn-disabled @else btn @endif">
                    {{ Form::radio('user_realty_type', $user_realty_type->id, $loop->first ? true : false, ['disabled' => $user_realty_type->status == 0 ? true : false]) }} {{ $user_realty_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group row">
        {!! Form::rawLabel('trade_type', 'Тип сделки<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($trade_types as $trade_type)
                <div class="@if ($loop->first) active @endif btn">
                    {{ Form::radio('trade_type', $trade_type->id, $loop->first ? true : false) }} {{ $trade_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group row">
        {!! Form::rawLabel('duration', 'Тип аренды<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($rent_durations as $rent_duration)
                <div class="@if ($loop->first) active @endif btn">
                    {{ Form::radio('duration', $rent_duration->id, $loop->first ? true : false) }} {{ $rent_duration->name }}
                </div>
            @endforeach
                <div class="hidden">
                    {{ Form::radio('duration', 0, false) }}
                </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::rawLabel('dop_type', 'Категория недвижимости<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($dop_types as $dop_type)
                <div class="@if ($loop->first) active @endif btn">
                    {{ Form::radio('dop_type', $dop_type->id, $loop->first ? true : false) }} {{ $dop_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group row">
        {!! Form::rawLabel('rent_type', 'Тип недвижимости<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($rent_types as $rent_type)
                <div class="@if ($loop->first) active @endif btn">
                    {{ Form::radio('rent_type', $rent_type->id, $loop->first ? true : false) }} {{ $rent_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    @if ($types->count() > 0)
        <div class="form-group row">
            {!! Form::rawLabel('rent_type', 'Объект<span>*</span>') !!}
            <div class="radio-grid rent-type rent-type-0">
                @foreach ($types->where('commercy', 0) as $type)
                    @include('realty.components.radio_grid', ['loop' => $loop, 'item' => $type, 'alias' => 'type', 'delimeter' => 3])
                @endforeach
            </div>

            <div class="radio-grid rent-type rent-type-1 d-none">
                @foreach ($types->where('commercy', 1) as $type)
                    @include('realty.components.radio_grid', ['loop' => $loop, 'item' => $type, 'alias' => 'type', 'delimeter' => 3])
                @endforeach
            </div>
        </div>

        <script>
            $('input[name=rent_type]').change(function () {
                $('.rent-type').addClass('d-none');
                $('.rent-type').prop('checked', false);
                $('.rent-type-' + $(this).val()).removeClass('d-none');
                $('.rent-type-' + $(this).val()).find('input[type="radio"]').eq(0).prop('checked', true);
            });

            $('input[name=rent_type]:checked').change();
        </script>
    @endif
</div>

<div class="realty-create-form-block">
    <div class="form-group row">
        {!! Form::rawLabel('address', 'Адрес<span>*</span>') !!}
        {{ Form::text('address', null, ['class' => 'form-control address-select', 'placeholder' => 'Город, улица']) }}
        {{ Form::hidden('address_city') }}
        {{ Form::hidden('address_street') }}
    </div>

    @if ($room_types->count() > 0)
        <div class="form-group row">
            {!! Form::rawLabel('rent_type', 'Количество комнат<span>*</span>') !!}
            <div class="radio-grid room_type">
                @foreach ($room_types as $room_type)
                    @include('realty.components.radio_grid', ['loop' => $loop, 'item' => $room_type, 'alias' => 'room_type', 'delimeter' => 3])
                @endforeach
            </div>

            <script>
                $('.room_type input[type=radio]').eq(0).prop('checked', true);
            </script>
        </div>
    @endif

    <div class="form-group row">
        {!! Form::rawLabel('info[floor]', 'Этаж<span>*</span>') !!}
        {{ Form::text('info[floor]', null, ['class' => 'form-control', 'style' => 'max-width: 300px;', 'placeholder' => 'Укажите свой этаж']) }}
    </div>

    <div class="form-group row">
        {!! Form::rawLabel('info[floors]', 'Этажей в доме<span>*</span>') !!}
        {{ Form::text('info[floors]', null, ['class' => 'form-control', 'style' => 'max-width: 300px;', 'placeholder' => 'Укажите этажность дома']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('info[common_square]', 'Общая площадь') }}
        {{ Form::text('info[common_square]', null, ['class' => 'form-control', 'style' => 'max-width: 87px;']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('info[living_square]', 'Жилая площадь') }}
        {{ Form::text('info[living_square]', null, ['class' => 'form-control', 'style' => 'max-width: 87px;']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('info[kitchen_square]', 'Площадь кухни') }}
        {{ Form::text('info[kitchen_square]', null, ['class' => 'form-control', 'style' => 'max-width: 87px;']) }}
    </div>
</div>

<div class="realty-create-form-block">
    @if (count($comforts) > 0)
        <div class="form-group row checkbox-grid-wrap">
            @foreach ($comforts as $cat_name => $comfort_cat)
                <div class="checkbox-grid row col-md-4">
                    {{ Form::label('comfort', $cat_name) }}

                    @foreach ($comfort_cat as $comfort)
                        <div>
                            {{ Form::checkbox('comfort['.$comfort->id.']', null, null, ['id' => 'comfort-'.$comfort->id, 'class' => 'checkbox blue']) }}
                            {{ Form::label('comfort-'.$comfort->id, $comfort->name) }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="realty-create-form-block">
    <div class="form-group row">
        {!! Form::rawLabel('photos', 'Фотографии<span>*</span>') !!}
        <div class="label-desc">Не допускаются к размещению фотографии с водяными знаками, чужих объектов и рекламные баннеры. JPG, PNG или GIF.<br>Максимальный размер файла 10 мб</div>
        <div class="dropzone-wrap" id="dropzoneupload" data-name="photos[]"></div>
        <div class="float-photo-info">Добавьте не менее 3-х фотографий интерьера, дающих полноценное представление об объекте. Допускается использование только реальных фотографий предлагаемого объекта, которые не должны нарушать чьи-либо интеллектуальные права. Правилами сайта запрещено использование картинок (кроме схемы объекта), 3D, коллажей, скриншотов, а также изображений, на которых присутствуют контактные данные, непрозрачные логотипы, посторонние визуальные элементы, чужие водяные знаки или следы их ликвидации. Запрещено прикреплять к объявлениям фотографии, содержащие изображения людей, животных, алкогольных напитков, табачных изделий, оружия или других подобных предметов.</div>
    </div>

    <div class="form-group row">
        {!! Form::label('floor', 'Видео') !!}
        <div class="d-table w-100">
            <div class="d-table-cell">
                {{ Form::text('youtube', null, ['class' => 'form-control', 'placeholder' => 'Ссылка на Youtube']) }}
            </div>

            <div class="d-table-cell add-video-cell">
                <div class="btn btn-lg btn-primary add-video">Добавить</div>
            </div>
    </div>

    <div class="realty-added-videos">

    </div>
</div>

<div class="realty-create-form-block">
    <div class="form-group row">
        {!! Form::rawLabel('content', 'Описание объявления<span>*</span>') !!}
        {{ Form::textarea('content', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('price', 'Стоимость') }}
        <div class="price-input">
            {{ Form::text('price', null, ['class' => 'form-control', 'style' => 'max-width: 300px;', 'maxlength' => '16']) }}
            <span class="currency-price-input">руб.</span>
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('', '') }}
        {{ Form::checkbox('info[with_communal]', null, null, ['id' => 'with_communal', 'class' => 'checkbox blue']) }}
        {{ Form::label('with_communal', 'Коммунальные услуги включены') }}
    </div>
</div>

<div class="form-group row float-right">
    <button class="btn btn-lg active" style="margin-right: 0;">Опубликовать объявление</button>
</div>
