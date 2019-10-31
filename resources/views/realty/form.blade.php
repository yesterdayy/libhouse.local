@csrf

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
        {{ Form::text('address', null, ['class' => 'form-control address-input', 'placeholder' => 'Город, улица']) }}
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
        {!! Form::rawLabel('floor', 'Этаж<span>*</span>') !!}
        {{ Form::text('floor', null, ['class' => 'form-control', 'style' => 'max-width: 300px;', 'placeholder' => 'Укажите свой этаж']) }}
    </div>

    <div class="form-group row">
        {!! Form::rawLabel('floors', 'Этажей в доме<span>*</span>') !!}
        {{ Form::text('floors', null, ['class' => 'form-control', 'style' => 'max-width: 300px;', 'placeholder' => 'Укажите этажность дома']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('common_square', 'Общая площадь') }}
        {{ Form::text('common_square', null, ['class' => 'form-control', 'style' => 'max-width: 87px;']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('living_square', 'Жилая площадь') }}
        {{ Form::text('living_square', null, ['class' => 'form-control', 'style' => 'max-width: 87px;']) }}
    </div>

    <div class="form-group row">
        {{ Form::label('kitchen_square', 'Площадь кухни') }}
        {{ Form::text('kitchen_square', null, ['class' => 'form-control', 'style' => 'max-width: 87px;']) }}
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
        {{ Form::text('floor', null, ['class' => 'form-control', 'placeholder' => 'Ссылка на Youtube']) }}
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
        {{ Form::checkbox('with_communal', null, null, ['id' => 'with_communal', 'class' => 'checkbox blue']) }}
        {{ Form::label('with_communal', 'Коммунальные услуги включены') }}
    </div>
</div>

<div class="form-group row float-right">
    <button class="btn btn-lg active" style="margin-right: 0;">Опубликовать объявление</button>
</div>

<script>
    var photo_upload_dropzone = $(".dropzone-wrap").dropzone({
        thumbnailWidth: 400,
        thumbnailHeight: 400,
        dictDefaultMessage: 'Добавить фото',
        previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <ul class=\"dz-details\"><li class=\"set-main-photo\">Сделать главной</li></ul>\n</div>",
        url: "/upload/photo",
        maxFiles: 8,
        maxFilesize: 10,
        acceptedFiles: '.jpg, .png, .gif',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file) {
            if (typeof file !== 'undefined' && file.hasOwnProperty('xhr')) {
                let result = JSON.parse(file.xhr.response);
                let file_id = result.id;

                $(this.element).append('<input type="hidden" name="' + $(this.element).attr('data-name') + '" value="' + file_id + '" />');
            }
        },
        addedfile: function addedfile(file) {
            var _this2 = this;

            if (this.element === this.previewsContainer) {
                this.element.classList.add("dz-started");
            }

            if (this.previewsContainer) {
                file.previewElement = Dropzone.createElement(this.options.previewTemplate.trim());
                file.previewTemplate = file.previewElement; // Backwards compatibility

                this.previewsContainer.prepend(file.previewElement);
                $('.dz-message', this.element).css({display: 'inline-block', margin: '15px'});
                for (var _iterator3 = file.previewElement.querySelectorAll("[data-dz-name]"), _isArray3 = true, _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
                    var _ref3;

                    if (_isArray3) {
                        if (_i3 >= _iterator3.length) break;
                        _ref3 = _iterator3[_i3++];
                    } else {
                        _i3 = _iterator3.next();
                        if (_i3.done) break;
                        _ref3 = _i3.value;
                    }

                    var node = _ref3;

                    node.textContent = file.name;
                }
                for (var _iterator4 = file.previewElement.querySelectorAll("[data-dz-size]"), _isArray4 = true, _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
                    if (_isArray4) {
                        if (_i4 >= _iterator4.length) break;
                        node = _iterator4[_i4++];
                    } else {
                        _i4 = _iterator4.next();
                        if (_i4.done) break;
                        node = _i4.value;
                    }

                    node.innerHTML = this.filesize(file.size);
                }

                if (this.options.addRemoveLinks) {
                    file._removeLink = Dropzone.createElement("<a class=\"dz-remove\" href=\"javascript:undefined;\" data-dz-remove>" + this.options.dictRemoveFile + "</a>");
                    file.previewElement.appendChild(file._removeLink);
                }

                var removeFileEvent = function removeFileEvent(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (file.status === Dropzone.UPLOADING) {
                        return Dropzone.confirm(_this2.options.dictCancelUploadConfirmation, function () {
                            return _this2.removeFile(file);
                        });
                    } else {
                        if (_this2.options.dictRemoveFileConfirmation) {
                            return Dropzone.confirm(_this2.options.dictRemoveFileConfirmation, function () {
                                return _this2.removeFile(file);
                            });
                        } else {
                            return _this2.removeFile(file);
                        }
                    }
                };

                for (var _iterator5 = file.previewElement.querySelectorAll("[data-dz-remove]"), _isArray5 = true, _i5 = 0, _iterator5 = _isArray5 ? _iterator5 : _iterator5[Symbol.iterator]();;) {
                    var _ref4;

                    if (_isArray5) {
                        if (_i5 >= _iterator5.length) break;
                        _ref4 = _iterator5[_i5++];
                    } else {
                        _i5 = _iterator5.next();
                        if (_i5.done) break;
                        _ref4 = _i5.value;
                    }

                    var removeLink = _ref4;

                    removeLink.addEventListener("click", removeFileEvent);
                }
            }
        },
    });

    $('.select2-city').select2({
        ajax: {
            url: '/kladr/city',
            dataType: 'json',
        }
    });

    $('.select2-street').select2({
        ajax: {
            url: '/kladr/street',
            dataType: 'json',
            data: function(params){
                params.city_code = $('.select2-city').val()
                return params;
            },
        }
    });
</script>
