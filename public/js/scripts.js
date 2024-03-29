// Обработчики событий
$(function () {
    $('.current-city-wrap').click(function () {
        let content = $('.city-pick-modal');
        content.removeClass('d-none');
        let modal = {
            title: 'Выберите регион или город',
            content: content[0],
        };
        show_modal(modal);
    });

    // Фильтр в шапке
    init_header_filters();

    // Закрываем другие popover если один уже открыт или если кликнули на пустом месте
    $(document).click(function (e) {
        let elem = $(e.target).attr('rel') == 'popover' ? $(e.target) : $(e.target).closest('[rel=popover]');

        if (elem.length === 0 && !$(e.target).hasClass('popover') && $(e.target).closest('.popover').length === 0 || elem.length > 0 && $('.popover').length > 1) {
            $('[rel=popover]').not(elem).popover('hide');
        }
    });
});

function init_header_filters() {
    $('.adv-rent-type-popup').popover({
        content: $('.header-rent-types').html(),
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '-5px 9px',
        sanitize: false,
    });

    $('.adv-type-popup').popover({
        content: $('.header-types > div').html(),
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '194px 9px',
        sanitize: false,
    });

    $('.adv-floors-popup').popover({
        content: $('.header-floors ul')[0],
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '64px 9px',
        sanitize: false,
    });

    $('.adv-dop-type-popup').popover({
        content: $('.header-dop-types').html(),
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '62px 9px',
        sanitize: false,
    });

    // Обычный список в фильтре
    $(document).on('click', '.header-filter-simple-list:not(.with-checkboxes):not(.custom-event) li', function () {
        if (typeof $(this).attr('data-val') !== 'undefined') {
            var text_elem = '';
            if ($('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').length > 0) {
                $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val($(this).attr('data-val'));
                text_elem = $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('div[data-chars]');
            } else {
                $(this).closest('.d-none').parent().find('input[type=hidden]').val($(this).attr('data-val'));
                text_elem = $(this).closest('.d-none').parent().find('div[data-chars]');
            }
            text_elem.text($(this).attr('data-val').length > 0 ? $(this).text().trim().substr(0, text_elem.attr('data-chars')) : text_elem.attr('data-default-text'));
            $(this).toggleClass('active');
            $(this).closest('.popover').popover('hide');
        }
    });

    // Мультисписок в фильтре
    $(document).on('click', '.header-filter-multi-list li', function () {
        $(this).toggleClass('active');

        var value = [];
        var value_text = [];
        $('li.active', $(this).parent().parent()).each(function () {
            value.push($(this).attr('data-val'));
            value_text.push($(this).text().trim());
        });

        var text_elem = '';
        if ($('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').length > 0) {
            $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val(value);
            text_elem = $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('div[data-chars]');
        } else {
            $(this).closest('.d-none').parent().find('input[type=hidden]').val(value);
            text_elem = $(this).closest('.d-none').parent().find('div[data-chars]');
        }

        text_elem.text(value.length > 0 ? value_text.join(',').substr(0, text_elem.attr('data-chars')) : text_elem.attr('data-default-text'));
    });

    $(document).on('click', '.header-filter-simple-list.with-checkboxes > li', function (e) {
        if (!$(e.target).is('input[type=checkbox]') && !$(e.target).is('label')) {
            $('input[type=checkbox]', this).prop('checked', !$('input[type=checkbox]', this).prop('checked'));
        }

        var value = [];
        var value_text = [];
        $('input[type=checkbox]', $(this).parent()).each(function () {
            if ($(this).prop('checked')) {
                value.push($(this).closest('li').attr('data-val'))
                value_text.push($(this).closest('li').text().trim());
            }
        });

        $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val(value);
        let text_elem = $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('div[data-chars]');
        text_elem.text(value.length > 0 ? value_text.join(',').substr(0, text_elem.attr('data-chars')) : text_elem.attr('data-default-text'));
    });

    $('.header-select2').select2({
        width: '100%',
        disabled: 'readonly',
    });

    // Выбор города при выборе его в списке ниже
    $(document).on('click', '.popular-cities-pick li a', function (e) {
        e.preventDefault();
        $.cookie('city', $(this).closest('li').attr('data-val'));
        $('.current-city').text($(this).closest('li').attr('data-val'));
        show_toast({status: 'success', message: 'Сохранено'});
        hide_modal();
    });

    // Инпута выбора адреса в фильтре
    $('.header-address-input').autocomplete({
        serviceUrl: '/kladr/city_and_street',
        dataType: 'json',
        paramName: 'term',
        groupBy: 'cat',
        minChars: 3,
        containerClass: 'autocomplete-suggestions header-address-autocomplete',
        onSelect: function (suggestion) {
            $('input[name=city]', '.adv-address-popup').val(suggestion.data.city_name);
            if ('street_kladr' in suggestion.data) {
                $('input[name=street]', '.adv-address-popup').val(suggestion.data.street_name);
            } else {
                $('input[name=street]', '.adv-address-popup').val(null);
            }
        },
    });

    // Автовыбор 1-го результата, если его нет в выборке в фильтре
    autocomplete_close_listener('.header-address-input');

    // Поле выбора города пользователя
    $('.address-pick').autocomplete({
        serviceUrl: '/kladr/city',
        dataType: 'json',
        paramName: 'term',
        minChars: 3,
        onSelect: function (suggestion) {
            $('input[name=city]', '.adv-address-popup').val(suggestion.data.city_kladr);
            $.cookie('city', suggestion.value);
            $.cookie('city_kladr', suggestion.data.city_kladr);
            $('.current-city').text(suggestion.value);
            show_toast({status: 'success', message: 'Сохранено'});
            hide_modal();
        },
    });

    // Аутентификация окно
    $('.auth-login a').click(function (e) {
        e.preventDefault();
        $('.auth-reset-back').click();
        $('#auth-form-modal form').trigger('reset');
        $('#auth-form-modal').modal('show');
    });

    // Вход и Регистрация
    $('.login-form, .register-form').submit(function (e) {
        e.preventDefault();
        var that = this;

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(result) {
                $('input, textarea', that).removeClass('is-invalid');
                if ('status' in result && result.status == 'success') {
                    location.href = result.redirect;
                } else {
                    show_toast(result)
                }
            },
            error: function (result, test, arr) {
                $('input, textarea', that).removeClass('is-invalid');
                $('input, textarea', that).addClass('is-valid');
                if ('errors' in result.responseJSON) {
                    tooltip_err(result.responseJSON.errors, that);
                }
            },
        });
    });

    // Забыли пароль
    $('.reset-pass').click(function (e) {
        e.preventDefault();
        $('.auth-wrap').addClass('d-none');
        $('.reset-password-wrap').removeClass('d-none');
    })

    $('.reset-password-form').submit(function (e) {
        e.preventDefault();
        var that = this;

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(result) {
                $('input, textarea', that).removeClass('is-invalid');
                if ('status' in result && result.status == 'success') {
                    show_toast(result);
                }
            },
            error: function (result, test, arr) {
                $('input, textarea', that).removeClass('is-invalid');
                if ('errors' in result.responseJSON) {
                    tooltip_err(result.responseJSON.errors, that);
                }
            },
        });
    });

    // Назад (Забыли пароль)
    $('.auth-reset-back').click(function (e) {
        e.preventDefault();
        $('.auth-wrap').removeClass('d-none');
        $('.reset-password-wrap').addClass('d-none');
    })

    $(document).on('hidden.bs.toast', '.toast', function () {
        $(this).toast('dispose');
        $(this).remove();
    });

    $(document).on('click', '.realty-favorite-btn', function() {
        var id = $(this).attr('data-id');
        var that = this;

        $.ajax({
            type: 'GET',
            url: '/favorite/' + id,
            dataType: 'JSON',
            success: function(result) {
                if ('create' in result) {
                    $(that).addClass('active');
                    $('span', that).text('В избранном');
                } else if ('remove' in result) {
                    $(that).removeClass('active');
                    $('span', that).text('Добавить в избранное');
                }

                show_toast(result);
            },
            error: function (result, test, arr) {
                show_toast({status: 'error', message: 'Произошла ошибка. Повторите попытку позже.'})
            },
        });
    })

    $(document).on('click', '.header-search:not(.active)', function () {
        var that = this;
        $(this).addClass('active');
        $('form', this).removeClass('d-none');
        setTimeout(function () {
            $('input', that).addClass('show');
        }, 10);
    });

    $(document).on('click', '.header-search.active', function () {
        var that = this;
        $(this).addClass('active');
        $('form', this).removeClass('d-none');
        $('input', that).addClass('show');
    });
}

function show_modal(modal) {
    if (typeof modal !== 'undefined') {
        if (modal.hasOwnProperty('title') && modal.hasOwnProperty('content')) {
            $('#success-form-modal .modal-title').text(modal.title);
            $('#success-form-modal .modal-body').html(modal.content);
            $('#success-form-modal .modal-footer').html('');
        }

        if (modal.hasOwnProperty('buttons')) {
            modal.buttons = JSON.parse(modal.buttons);
            if (modal.buttons.length > 0) {
                modal.buttons.forEach(function (item) {
                    $('#success-form-modal .modal-footer').append('<button type="button" class="btn' + (item.hasOwnProperty('class') ? ' ' + item['class'] : '') + '" ' + (item.hasOwnProperty('onclick') ? 'onclick="' + item['onclick'] + '"' : '') + '>' + (item.hasOwnProperty('text') ? ' ' + item['text'] : '') + '</button>')
                });
            }
        }

        if (modal.hasOwnProperty('title') && modal.hasOwnProperty('content')) {
            $('#success-form-modal').modal('show');
            return true;
        }
    }
    return false;
}

function hide_modal() {
    $('#success-form-modal').modal('hide');
    return true;
}

function show_toast(toast_data) {
    var toast = $('.default-toast').eq(0).clone();
    toast.removeClass('default-toast');
    var toast_smile = '';
    if (toast_data.status == 'success') {
        toast.addClass('toast-success');
        toast_smile = '<i class="lh-icon lh-icon-toast-success"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></i>';
    } else {
        toast.addClass('toast-error');
        toast_smile = '<i class="lh-icon lh-icon-toast-error"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span></i>';
    }
    toast.html(toast_smile + ' ' + toast_data.message);
    $('.toasts-wrap').append(toast.removeClass('d-none').toast('show'));
}

function autocomplete_close_listener(selector, with_clear) {
    $(selector).blur(function () {
        var that = this;
        setTimeout(function () {
            if ($(that).autocomplete().suggestions.length > 0 && $(that).val().length > 2 && $(that).autocomplete().selection == null) {
                var val = $(that).val();
                var flag = false;

                if (!flag) {
                    $(that).autocomplete().onSelect(0);
                    $(that).trigger('close');
                }
            } else if ($(that).autocomplete().selection == null) {
                $(that).val(null);
                if ($(that).closest('.form-group').find('.address_city').length > 0) {
                    $(that).closest('.form-group').find('.address_city').val(null);
                    $(that).closest('.form-group').find('.address_street').val(null);
                }
            }
        }, 300);
    });
}

window.tooltip_err_timeout = null;
function tooltip_err(err_json, form) {
    $('.tooltip_err', form).popover('dispose');

    if (Object.keys(err_json).length) {
        for (var field in err_json) {
            if ($('[name='+field+']', form).length) {
                if (typeof $('[name=' + field + ']', form).data('bs.popover') !== 'undefined') {
                    $('[name=' + field + ']', form).attr('data-content', err_json[field][0]);
                } else {
                    $('[name=' + field + ']', form).attr('data-content', err_json[field][0]);
                    $('[name=' + field + ']', form).popover({
                        container: form,
                        html: true,
                        placement: 'right',
                        sanitize: false,
                        trigger: 'manual',
                        template: '<div class="popover tooltip_err" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                        offset: '0 5px'
                    });
                }

                $('[name=' + field + ']', form).popover('show');
                $('[name='+field+']', form).removeClass('is-valid').addClass('is-invalid');
            }
        }

        window.tooltip_err_timeout = setTimeout(function () {
            $('.tooltip_err', form).popover('dispose');
        }, 5000);
    }
}

function validation_toast(err) {
    if ('errors' in err.responseJSON) {
        var mesg = [];
        for (var prop in err.responseJSON.errors) {
            mesg.push(err.responseJSON.errors[prop][0]);
        }
        show_toast({status: 'error', message: mesg.join("<br>")});
    }
}
