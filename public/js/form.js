$(function () {
    // Если аренда, то открываем поля аренды, иначе выбираем hidden radio
    $('input[name=trade_type]').change(function () {
        var duration = $('input[name=duration]')[0];
        if ($(this).val() == '1') {
            $(duration).closest('.form-group').removeClass('d-none');
            $(duration).closest('.btn-group-toggle').find('input[name=duration]').eq(0).click();
        } else {
            $(duration).closest('.form-group').addClass('d-none');
            $(duration).closest('.btn-group-toggle').find('input[name=duration]').last().prop('checked', true);
        }
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
        serviceUrl: '/kladr/street_with_city',
        dataType: 'json',
        paramName: 'term',
        minChars: 3,
        onSearchStart: function (params) {
            params.city = $('input[name=address_city]').val();
        },
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

    // Сделать "Главным фото"
    $(document).on('click', '.set-main-photo', function () {
        let index = $(this).closest('.dz-preview').index();
        $(this).closest('.dropzone-wrap').prepend($(this).closest('.dz-preview'));
        $(this).closest('.dropzone-wrap').find('.dz-default.dz-message').after($(this).closest('.dropzone-wrap').find('input[type=hidden]').eq(index));
    });

    // Загрузка фото
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

                this.on("maxfilesexceeded", function (file) {
                    this.removeFile(file);
                });
            } else {

            }
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
});
