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
        offset: '-5px 5px',
        sanitize: false,
    });

    $('.adv-type-popup').popover({
        content: $('.header-types > div')[0],
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '194px 5px',
        sanitize: false,
    });

    $('.adv-floors-popup').popover({
        content: $('.header-floors ul')[0],
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '64px 5px',
        sanitize: false,
    });

    $('.adv-dop-type-popup').popover({
        content: $('.header-dop-types').html(),
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '62px 5px',
        sanitize: false,
    });

    // Обычный список в фильтре
    $(document).on('click', '.header-filter-simple-list:not(.with-checkboxes) li', function () {
        if (typeof $(this).attr('data-val') !== 'undefined') {
            $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val($(this).attr('data-val'));
            let text_elem = $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('div[data-chars]');
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
        $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val(value);
        let text_elem = $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('div[data-chars]');
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
        show_toast('Сохранено');
    });

    // Инпута выбора адреса в фильтре
    $('.header-address-input').autocomplete({
        serviceUrl: '/kladr/city_and_street',
        dataType: 'json',
        paramName: 'term',
        groupBy: 'cat',
        minChars: 3,
        containerClass: 'autocomplete-suggestions header-address-autocomplete',
        onSearchStart: function (params) {
            params.city = $('input[name=header_address_city]').val();
        },
        onSelect: function (suggestion) {
            $('input[name=header_address_city]').val(suggestion.data.city_kladr);
            if ('street_kladr' in suggestion.data) {
                $('input[name=header_address_street]').val(suggestion.data.street_kladr);
            } else {
                $('input[name=header_address_street]').val(null);
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
            $('input[name=header_address_city]').val(suggestion.data.city_kladr);
            $.cookie('city', suggestion.value);
            $.cookie('city_kladr', suggestion.data.city_kladr);
            $('.current-city').text(suggestion.value);
            show_toast('Сохранено');
        },
    });

    // Выбор города пользователя
    $('.address-pick').on('select2:select', function () {
        $.cookie('city', $(this).val());
        $('.current-city').text($(this).val());
        show_toast('Сохранено');
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

function show_toast(html) {
    var toast = $('#default-toast').clone();
    toast.html(html);
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
            }
        }, 300);
    });
}
