@csrf

{{ Html::script('js/form.min.js') }}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="form-errors">
            @foreach ($errors->all() as $error)
                <li>@if ($loop->first)<i class="lh-icon lh-icon-danger"></i> @endif{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="realty-create-form-block">
    <div class="form-group">
        {!! Form::rawLabel('user_realty_type', 'Тип аккаунта<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($user_realty_types as $user_realty_type)
                <div class="{{ (isset($old['user_realty_type']) && !empty($old['user_realty_type']) ? ($old['user_realty_type'] == $user_realty_type->id ? 'active' : '') : ($loop->first ? 'active' : '')) }} @if ($user_realty_type->status == 0) btn-disabled @else btn @endif">
                    {{ Form::radio('user_realty_type', $user_realty_type->id, (isset($old['user_realty_type']) && !empty($old['user_realty_type']) ? (boolean) ($old['user_realty_type'] == $user_realty_type->id) : ($loop->first ? true : false)), ['disabled' => $user_realty_type->status == 0 ? true : false, 'id' => null]) }} {{ $user_realty_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        {!! Form::rawLabel('trade_type', 'Тип сделки<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($trade_types as $trade_type)
                <div class="{{ (isset($old['trade_type']) && !empty($old['trade_type']) ? ($old['trade_type'] == $trade_type->id ? 'active' : '') : ($loop->first ? 'active' : '')) }} btn">
                    {{ Form::radio('trade_type', $trade_type->id, (isset($old['trade_type']) && !empty($old['trade_type']) ? (boolean) ($old['trade_type'] == $trade_type->id) : ($loop->first ? true : false)), ['id' => null]) }} {{ $trade_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        {!! Form::rawLabel('duration', 'Тип аренды<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($rent_durations as $rent_duration)
                <div class="{{ (isset($old['duration']) && !empty($old['duration']) ? ($old['duration'] == $rent_duration->id ? 'active' : '') : ($loop->first ? 'active' : '')) }} btn">
                    {{ Form::radio('duration', $rent_duration->id, (isset($old['duration']) && !empty($old['duration']) ? (boolean) ($old['duration'] == $rent_duration->id) : ($loop->first ? true : false)), ['id' => null]) }} {{ $rent_duration->name }}
                </div>
            @endforeach
                <div class="d-none">
                    {{ Form::radio('duration', 0, false) }}
                </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::rawLabel('dop_type', 'Категория недвижимости<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($dop_types as $dop_type)
                <div class="{{ (isset($old['dop_type']) && !empty($old['dop_type']) ? ($old['dop_type'] == $dop_type->id ? 'active' : '') : ($loop->first ? 'active' : '')) }} btn">
                    {{ Form::radio('dop_type', $dop_type->id, (isset($old['dop_type']) && !empty($old['dop_type']) ? (boolean) ($old['dop_type'] == $dop_type->id) : ($loop->first ? true : false)), ['id' => null]) }} {{ $dop_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        {!! Form::rawLabel('rent_type', 'Тип недвижимости<span>*</span>') !!}

        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($rent_types as $rent_type)
                <div class="{{ (isset($old['rent_type']) && !empty($old['rent_type']) ? ($old['rent_type'] == $rent_type->id ? 'active' : '') : ($loop->first ? 'active' : '')) }} btn">
                    {{ Form::radio('rent_type', $rent_type->id, (isset($old['rent_type']) && !empty($old['rent_type']) ? (boolean) ($old['rent_type'] == $rent_type->id) : ($loop->first ? true : false)), ['id' => null]) }} {{ $rent_type->name }}
                </div>
            @endforeach
        </div>
    </div>

    @if ($types->count() > 0)
        <div class="form-group">
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
                if ($('.rent-type-' + $(this).val()).find('input[type="radio"]:checked').length === 0) {
                    $('.rent-type-' + $(this).val()).find('input[type="radio"]').eq(0).prop('checked', true);
                }
            });

            $('input[name=rent_type]:checked').change();
        </script>
    @endif
</div>

<div class="realty-create-form-block">
    <div class="form-group">
        {!! Form::rawLabel('address', 'Адрес<span>*</span>') !!}
        {{ Form::text('address', null, ['class' => 'form-control address-select autocomplete-input ' . ($errors->has('address_city') || $errors->has('address_street') ? 'is-invalid' : (isset($old['address_city']) && !empty($old['address_city']) ? 'is-valid' : '')), 'placeholder' => 'Город, улица']) }}
        {{ Form::hidden('address_city') }}
        {{ Form::hidden('address_street') }}
    </div>

    @if ($house_classes->count() > 0)
        <div class="form-group d-none house-classes">
            {{ Form::label('house_classes', 'Класс здания') }}
            @foreach ($house_classes as $house_class)
                <div class="d-inline-block">
                    {{ Form::radio('house_class', $house_class->id, (isset($old['house_class']) && !empty($old['house_class']) ? (boolean) ($old['house_class'] == $house_class->id) : null), ['class' => 'radio', 'id' => 'house_class' . '_' . $house_class->id]) }}
                    {{ Form::label('house_class' . '_' . $house_class->id, $house_class->name) }}
                </div>
            @endforeach
        </div>
    @endif

    @if ($room_types->count() > 0)
        <div class="form-group">
            {!! Form::rawLabel('rent_type', 'Количество комнат<span>*</span>') !!}
            <div class="radio-grid room_type">
                @foreach ($room_types as $room_type)
                    @include('realty.components.radio_grid', ['loop' => $loop, 'item' => $room_type, 'alias' => 'room_type', 'delimeter' => 3])
                @endforeach
            </div>

            <script>
                if ($('.room_type input[type=radio]:checked').length === 0) {
                    $('.room_type input[type=radio]').eq(0).prop('checked', true);
                }
            </script>
        </div>
    @endif

    <div class="d-table form-inline-table">
        <div class="form-group d-table-cell">
            {!! Form::rawLabel('info[floor]', 'Этаж<span>*</span>') !!}
            {{ Form::text('info[floor]', null, ['class' => 'form-control ' . ($errors->has('info.floor') ? 'is-invalid' : (isset($old['info[floor]']) && !empty($old['info[floor]']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;']) }}
        </div>

        <div class="form-group d-table-cell">
            {!! Form::rawLabel('info[floors]', 'Этажей в доме<span>*</span>') !!}
            {{ Form::text('info[floors]', null, ['class' => 'form-control ' . ($errors->has('info.floors') ? 'is-invalid' : (isset($old['info[floors]']) && !empty($old['info[floors]']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;']) }}
        </div>
    </div>

    <div class="d-table form-inline-table">
        <div class="form-group d-table-cell">
            {{ Form::label('info[square_common]', 'Общая площадь') }}
            {{ Form::text('info[square_common]', null, ['class' => 'form-control ' . ($errors->has('info.square_common') ? 'is-invalid' : (isset($old['info[square_common]']) && !empty($old['info[square_common]']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;']) }}
        </div>

        <div class="form-group d-table-cell">
            {{ Form::label('info[square_living]', 'Жилая площадь') }}
            {{ Form::text('info[square_living]', null, ['class' => 'form-control ' . ($errors->has('info.square_living') ? 'is-invalid' : (isset($old['info[square_living]']) && !empty($old['info[square_living]']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;']) }}
        </div>

        <div class="form-group d-table-cell">
            {{ Form::label('info[square_kitchen]', 'Площадь кухни') }}
            {{ Form::text('info[square_kitchen]', null, ['class' => 'form-control ' . ($errors->has('info.square_kitchen') ? 'is-invalid' : (isset($old['info[square_kitchen]']) && !empty($old['info[square_kitchen]']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;']) }}
        </div>
    </div>

    <div class="commercy-info-wrap"></div>
</div>

<div class="realty-create-form-block comfort-add-wrap">
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
    <div class="form-group">
        {!! Form::rawLabel('photos', 'Фотографии<span>*</span>') !!}
        <div class="label-desc">Не допускаются к размещению фотографии с водяными знаками, чужих объектов и рекламные баннеры. JPG, PNG или GIF.<br>Максимальный размер файла 10 мб</div>
        <div class="dropzone-wrap" id="dropzoneupload" data-name="photos[]"></div>
        <div class="float-photo-info">Добавьте не менее 3-х фотографий интерьера, дающих полноценное представление об объекте. Допускается использование только реальных фотографий предлагаемого объекта, которые не должны нарушать чьи-либо интеллектуальные права. Правилами сайта запрещено использование картинок (кроме схемы объекта), 3D, коллажей, скриншотов, а также изображений, на которых присутствуют контактные данные, непрозрачные логотипы, посторонние визуальные элементы, чужие водяные знаки или следы их ликвидации. Запрещено прикреплять к объявлениям фотографии, содержащие изображения людей, животных, алкогольных напитков, табачных изделий, оружия или других подобных предметов.</div>
        <script>
            window.realty_photos = {!! $photos !!};
        </script>
    </div>

    <div class="form-group">
        {!! Form::label('floor', 'Видео') !!}
        <div class="d-table w-100">
            <div class="d-table-cell">
                {{ Form::text('youtube', null, ['class' => 'form-control', 'placeholder' => 'Ссылка на Youtube']) }}
            </div>

            <div class="d-table-cell add-video-cell">
                <div class="btn btn-lg btn-primary add-video" tabindex="0">Добавить</div>
            </div>
        </div>
    </div>

    <div class="realty-added-videos">

    </div>
</div>

<div class="realty-create-form-block last-realty-add-wrap">
    <div class="form-group d-none">
        {{ Form::label('title', 'Название объявления') }}
        {{ Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? 'is-invalid' : (isset($old['title']) && !empty($old['title']) ? 'is-valid' : ''))]) }}
    </div>

    <div class="form-group">
        {!! Form::rawLabel('content', 'Описание объявления<span>*</span>') !!}
        {{ Form::textarea('content', null, ['class' => 'form-control ' . ($errors->has('content') ? 'is-invalid' : (isset($old['content']) && !empty($old['content']) ? 'is-valid' : ''))]) }}
    </div>

    <div class="d-table form-inline-table">
        <div class="form-group row d-table-cell">
            {{ Form::label('price', 'Арендная плата') }}
            {{ Form::text('price', null, ['class' => 'form-control d-inline-block' . ($errors->has('price') ? 'is-invalid' : (isset($old['price']) && !empty($old['price']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;', 'maxlength' => '16']) }}
            <span class="currency-price-input">руб.</span>
        </div>

        <div class="form-group row d-table-cell" style="display: none;">
            {{ Form::label('comission', 'Размер комиссии') }}
            {{ Form::text('info[comission]', null, ['class' => 'form-control d-inline-block' . ($errors->has('price') ? 'is-invalid' : (isset($old['price']) && !empty($old['price']) ? 'is-valid' : '')), 'style' => 'max-width: 150px;', 'maxlength' => '16', 'id' => 'comission']) }}
            <span class="currency-price-input">%</span>
        </div>

        <div class="form-group row d-table-cell">
            {{ Form::label('realty-add-phone', 'Номер телефона для связи') }}
            {{ Form::text('phone', null, ['class' => 'form-control ' . ($errors->has('phone') ? 'is-invalid' : (isset($old['phone']) && !empty($old['phone']) ? 'is-valid' : '')), 'style' => 'max-width: 300px;', 'maxlength' => '20', 'id' => 'realty-add-phone']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('', '') }}
        {{ Form::checkbox('info[with_communal]', null, null, ['id' => 'with_communal', 'class' => 'checkbox blue']) }}
        {{ Form::label('with_communal', 'Коммунальные услуги включены') }}
    </div>
</div>

<div class="form-group float-right">
    <button class="btn btn-lg active add-realty" style="margin-right: 0;">Опубликовать объявление</button>
</div>

<script>
    $(function() {
        $('.btn-group-toggle .btn.active input').change();
        hidden_field_set_null_value('.realty-create-form');
    });
</script>
