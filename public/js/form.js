$(function () {
    realty_form_validaition('.realty-create-form');

    // Если аренда, то открываем поля аренды, иначе выбираем hidden radio
    $('input[name=trade_type]').change(function () {
        var duration = $('input[name=duration]')[0];
        if ($(this).val() == '1') {
            $('label[for=price]').text('Арендная плата');
            $('.comfort-add-wrap').show();

            switch ($(this).closest('form').find('[name="user_realty_type"]:checked').val()) {
                case '1':
                    $('#comission').closest('.form-group').hide();
                    break;

                case '2':
                    $('#comission').closest('.form-group').show();
                    break;
            }

            $(duration).closest('.form-group').show();
            $(duration).closest('.btn-group-toggle').find('input[name=duration]').eq(0).click();
            toggle_commercy_fields(false);
        } else {
            $('label[for=price]').text('Цена');
            $('.comfort-add-wrap').hide();
            $('#comission').closest('.form-group').hide();
            $(duration).closest('.form-group').hide();
            $(duration).closest('.btn-group-toggle').find('input[name=duration]').last().prop('checked', true);

            if (
                $(this).closest('form').find('[name="user_realty_type"]:checked').val() == '2'
                && $(this).closest('form').find('[name="rent_type"]:checked').val() == '1'
            ) {
                toggle_commercy_fields(true);
            } else {
                toggle_commercy_fields(false);
            }

            $('input[name="info[with_communal]"]').closest('.form-group').hide();
        }
        hidden_field_set_null_value('.realty-create-form');
    });

    // Если посуточная аренда, то убираем комиссию
    $('input[name=duration]').change(function () {
        if ($(this).val() == '3') {
            $('input[name="info[with_communal]"]').closest('.form-group').hide();
        } else {
            $('input[name="info[with_communal]"]').closest('.form-group').show();
        }
        hidden_field_set_null_value('.realty-create-form');
    });

    // Если аренда и агент, то добавляем поле коммиссия
    $('input[name=user_realty_type]').change(function () {
        if ($(this).closest('form').find('[name="trade_type"]:checked').val() == '1') {
            switch ($(this).val()) {
                case '1':
                    $('#comission').closest('.form-group').hide();
                    toggle_commercy_fields(false);
                    break;

                case '2':
                    $('#comission').closest('.form-group').show();
                    toggle_commercy_fields(false);
                    break;
            }
        }
        else {
            if (
                $(this).val() == '2'
                && $(this).closest('form').find('[name="trade_type"]:checked').val() == '2'
                && $(this).closest('form').find('[name="rent_type"]:checked').val() == '1'
            ) {
                toggle_commercy_fields(true);
            } else {
                toggle_commercy_fields(false);
            }
        }
        hidden_field_set_null_value('.realty-create-form');
    });

    // Если продажа коммереской недвижимости, то меняем поля для заполнения
    $('input[name=rent_type]').change(function () {
        if ($(this).closest('form').find('[name="trade_type"]:checked').val() == '2') {
            switch ($(this).val()) {
                case '0':
                    toggle_commercy_fields(false);
                    break;

                case '1':
                    if ($(this).closest('form').find('[name="user_realty_type"]:checked').val() == '2') {
                        toggle_commercy_fields(true);
                    } else {
                        toggle_commercy_fields(false);
                    }
                    break;
            }
        } else {
            if ($(this).closest('form').find('[name="user_realty_type"]:checked').val() == '2') {
                $('#comission').closest('.form-group').show();
            }
            toggle_commercy_fields(false);
        }
        hidden_field_set_null_value('.realty-create-form');
    });

    // Добавление видео
    $('.add-video').click(function () {
        var elem = $('input[name=youtube]');
        var video_link = elem.val();

        if (video_link.length === 0) {
            alert('Нет видео, чтобы добавить.');
            return false;
        }

        if (video_link.indexOf('youtube') !== -1 && video_link.indexOf('youtu.be') !== -1) {
            alert('Видео должно быть с видеохостинга YouTube.');
            return false;
        }

        var html = '';
        html += '<div class="form-group row">';
        html += '<label>' + video_link + ' <a href="#" class="realty-delete-video float-right">Удалить</a></label>';
        html += '<iframe width="560" height="315" src="' + video_link.replace('watch?v=', 'embed/').split('&')[0]  + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>';
        html += '<input name="info[youtube][]" value="' + video_link.replace('watch?v=', 'embed/').split('&')[0] + '" type="hidden" />';
        html += '</div>';

        $('.realty-added-videos').append(html);
        elem.val('');
    });

    // Удаление видео
    $(document).on('click', '.realty-delete-video', function (e) {
        e.preventDefault();
        $(this).closest('.form-group').remove();
    });

    // Инпута выбора адреса
    $('.address-select').autocomplete({
        serviceUrl: '/kladr/city_and_street',
        dataType: 'json',
        paramName: 'term',
        minChars: 3,
        preventBadQueries: false,
        groupBy: 'cat',
        onSelect: function (suggestion) {
            $('input[name=address_city]').val(suggestion.data.city_kladr);
            if ('street_kladr' in suggestion.data) {
                $('input[name=address_street]').val(suggestion.data.street_kladr);
            } else {
                $('input[name=address_street]').val(null);
            }
        },
    });

    // Автовыбор 1-го результата, если его нет в выборке
    autocomplete_close_listener('.address-select');

    // Сделать Главным фото
    $(document).on('click', '.set-main-photo', function () {
        let index = $(this).closest('.dz-preview').index();
        $(this).closest('.dropzone-wrap').prepend($(this).closest('.dz-preview'));
        $(this).closest('.dropzone-wrap').find('.dz-default.dz-message').after($(this).closest('.dropzone-wrap').find('input[type=hidden]').eq(index));
    });

    // Повернуть фото
    $(document).on('click', '.rotate-photo', function () {
        var elem = $(this).closest('.dz-preview').find('.dz-image');
        var rotate_param = '';
        var index = $(this).closest('.dz-preview').index();

        if (elem.hasClass('rotate-90')) {
            elem.removeClass('rotate-90');
            elem.addClass('rotate-180');
            rotate_param = 180;
        }
        else if (elem.hasClass('rotate-180')) {
            elem.removeClass('rotate-180');
            elem.addClass('rotate-270');
            rotate_param = 270;
        }
        else if (elem.hasClass('rotate-270')) {
            elem.removeClass('rotate-270');
        }
        else {
            elem.addClass('rotate-90');
            rotate_param = 90;
        }

        if (rotate_param) {
            $(this).closest('.dropzone-wrap').find('input[type=hidden]').eq(index).val(parseInt($(this).closest('.dropzone-wrap').find('input[type=hidden]').eq(index).val()) + '-' + rotate_param);
        } else {
            $(this).closest('.dropzone-wrap').find('input[type=hidden]').eq(index).val(parseInt($(this).closest('.dropzone-wrap').find('input[type=hidden]').eq(index).val()));
        }
    });

    // Загрузка фото
    var photo_upload_dropzone = $(".dropzone-wrap").dropzone({
        thumbnailWidth: 400,
        thumbnailHeight: 400,
        dictDefaultMessage: 'Добавить фото',
        previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <ul class=\"dz-details\"><li class=\"set-main-photo\">Сделать главной</li><li class=\"rotate-photo\"><i class='lh-icon lh-icon-update'></i>Повернуть</li><li class=\"remove-photo\" data-dz-remove>Удалить</li></ul>\n</div>",
        url: "/upload/photo",
        maxFiles: 8,
        maxFilesize: 10,
        acceptedFiles: '.jpg, .png, .gif',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            if (typeof window.realty_photos !== 'undefined' && window.realty_photos.length > 0) {
                var thisDropzone = this;
                window.realty_photos.forEach(function (photo) {
                    var mockFile = {name: photo.original_name, size: photo.size, type: photo.mime};
                    thisDropzone.emit("addedfile", mockFile);
                    thisDropzone.emit("success", mockFile);
                    thisDropzone.emit("thumbnail", mockFile, photo.thumbnails['slide-thumb'])
                    $(thisDropzone.element).append('<input type="hidden" name="photos[]" value="' + photo.id + '" />');
                });

                $(this.element).closest('form').find('.add-realty').prop('disabled', false);

                this.on("maxfilesexceeded", function (file) {
                    this.removeFile(file);
                });
            } else {

            }
        },
        queuecomplete: function() {
            $(this.element).closest('form').find('.add-realty').prop('disabled', false);
        },
        success: function(file) {
            if (typeof file !== 'undefined' && file.hasOwnProperty('xhr')) {
                let result = JSON.parse(file.xhr.response);
                let file_id = result.id;

                $(this.element).append('<input type="hidden" name="' + $(this.element).attr('data-name') + '" value="' + file_id + '" />');
            }
        },
        removedfile: function addedfile(file) {
            if (file.previewElement != null && file.previewElement.parentNode != null) {
                let index = $(file.previewElement).index();
                $(file.previewElement).closest('.dropzone-wrap').find('input[type=hidden]').eq(index).remove();
                file.previewElement.parentNode.removeChild(file.previewElement);
            }
            return this._updateMaxFilesReachedClass();
        },
        addedfile: function addedfile(file) {
            var _this2 = this;

            $(this.element).closest('form').find('.add-realty').prop('disabled', true);

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
});

function toggle_commercy_fields(show) {
    if (show) {
        $('.house-classes').show();
        $('input[name="info[floor]"]').closest('.form-group').hide();
        $('input[name="info[floors]"]').closest('.form-group').hide();
        $('input[name="info[square_common]"]').closest('.form-group').find('label').text('Площадь');
        $('input[name="info[square_living]"]').closest('.form-group').hide();
        $('input[name="info[square_kitchen]"]').closest('.form-group').hide();
        $('input[name="info[with_communal]"]').closest('.form-group').hide();
        $('.comfort-add-wrap').hide();
        $('.room_type').closest('.form-group').hide();

        $('input[name="title"]').closest('.form-group').show();
        if ($('.last-realty-add-wrap').html().length > 0) {
            $('.commercy-info-wrap').html($('.last-realty-add-wrap').html());
            $('.last-realty-add-wrap').html('');
        }
    }
    else {
        $('.house-classes').hide();
        $('input[name="info[floor]"]').closest('.form-group').show();
        $('input[name="info[floors]"]').closest('.form-group').show();
        $('input[name="info[square_common]"]').closest('.form-group').find('label').text('Общая площадь');
        $('input[name="info[square_living]"]').closest('.form-group').show();
        $('input[name="info[square_kitchen]"]').closest('.form-group').show();
        $('input[name="info[with_communal]"]').closest('.form-group').show();
        $('.room_type').closest('.form-group').show();

        $('input[name="title"]').closest('.form-group').hide();
        if ($('.commercy-info-wrap').html().length > 0) {
            $('.last-realty-add-wrap').html($('.commercy-info-wrap').html());
            $('.commercy-info-wrap').html('');
        }
    }
}

function hidden_field_set_null_value(form) {
    setTimeout(function () {
        $('.form-group:hidden input:not([type=radio]):not([type=checkbox])', form).val(null);
        $('.form-group:hidden input[type=radio], .form-group:hidden input[type=checkbox]', form).prop('checked', false);
        $('.form-group:hidden input[type=radio]', form).each(function() {
            if ($(this).parent().hasClass('btn')) {
                $(this).parent().removeClass('active');
            }
        });

        $('.form-group:hidden select', form).val(null).change();
    }, 50);
}

function realty_form_validaition(form) {
    bootstrapValidate($('[name="address"]', form)[0], 'required');

    bootstrapValidate($('[name="info[floor]"]', form)[0], 'required|integer');
    bootstrapValidate($('[name="info[floors]"]', form)[0], 'required|integer');
    bootstrapValidate($('[name="info[square_common]"]', form)[0], 'integer');
    bootstrapValidate($('[name="info[square_living]"]', form)[0], 'integer');
    bootstrapValidate($('[name="info[square_kitchen]"]', form)[0], 'integer');

    bootstrapValidate($('[name="youtube"]', form)[0], 'url');

    bootstrapValidate($('[name="content"]', form)[0], 'required|max:3000:test');
    bootstrapValidate($('[name="price"]', form)[0], 'integer');

    if ($('[name="comission"]', form).length > 0 && $('[name="comission"]', form).parent().is(':visible')) {
        bootstrapValidate($('[name="comission"]', form)[0], 'integer');
    }
}
