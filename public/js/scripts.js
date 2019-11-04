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
    $('.header-address-input').on('input', function () {
        if ($(this).val().length > 2) {
            var that = this;
            var address_ajax_flag = $(this).val().length;

            setTimeout(function () {
                if ($(that).val().length == address_ajax_flag) {
                    $.ajax({
                        url: '/kladr/city_and_street?term=' + $(that).val(),
                        data: {
                            bold: 1,
                            view: 'li',
                        },
                        dataType: "json",
                        success: function (result) {
                            $('.header-street').html(result.street);
                            $('.header-city').html(result.city);

                            setTimeout(function () {
                                $('.adv-address-popup').popover('show');
                            }, 100);
                        }
                    });
                }
            }, 300);
        } else {
            $('.adv-address-popup').popover('hide');
        }
    });

    $('.adv-address-popup').popover({
        content: function () {
            return $('.header-address').html();
        },
        container: '.adv-form-header',
        trigger: 'manual',
        html: true,
        placement: 'bottom',
        offset: '8px 15px',
        sanitize: false,
        template: '<div class="popover address-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
    });

    $('.adv-rent-type-popup').popover({
        content: $('.header-rent-types').html(),
        container: '.adv-form-header',
        html: true,
        placement: 'bottom',
        offset: '-5px 5px',
        sanitize: false,
    });

    $('.adv-type-popup').popover({
        content: $('.header-types').html(),
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
            $(this).toggleClass('active');
            $(this).closest('.popover').popover('hide');
        }
    });

    // Мультисписок в фильтре
    $(document).on('click', '.header-filter-multi-list li', function () {
        $(this).toggleClass('active');

        var value = [];
        $('li.active', $(this).parent().parent()).each(function () {
            value.push($(this).attr('data-val'))
        });
        $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val(value);
    });

    $(document).on('click', '.header-filter-simple-list.with-checkboxes > li', function (e) {
        if (!$(e.target).is('input[type=checkbox]') && !$(e.target).is('label')) {
            $('input[type=checkbox]', this).prop('checked', !$('input[type=checkbox]', this).prop('checked'));
        }

        var value = [];
        $('input[type=checkbox]', $(this).parent()).each(function () {
            if ($(this).prop('checked')) {
                value.push($(this).closest('li').attr('data-val'))
            }
        });

        $('.adv-form-header div[aria-describedby='+$(this).closest('.popover').attr('id')+']').find('input[type=hidden]').val(value);
    });

    $('.header-select2').select2({
        width: '100%',
        disabled: 'readonly',
    });

    // select2 для выбора города
    $('.address-pick').select2({
        width: '100%',
        minimumInputLength: 3,
        minimumResultsForSearch: 1,
        ajax: {
            url: '/kladr/city?noid=1',
            dataType: 'json',
        },
        language: {
            inputTooShort: function() {
                return 'Введите название населенного пункта';
            },
            "noResults": function(){
                return "ничего не найдено";
            }
        },
        dropdownParent: $('.city-pick-modal'),
        selectionAdapter: $.fn.select2.amd.require("SearchableSingleSelection"),
        dropdownAdapter: $.fn.select2.amd.require("UnsearchableDropdown")
    });

    // Выбор города при изменении select2
    $('.address-pick').on('select2:select', function () {
        $.cookie('city', $(this).val());
        $('.current-city').text($(this).val());
        show_toast('Сохранено');
    });

    // Выбор города при выборе его в списке ниже
    $(document).on('click', '.popular-cities-pick li a', function (e) {
        e.preventDefault();
        $.cookie('city', $(this).closest('li').attr('data-val'));
        $('.current-city').text($(this).closest('li').attr('data-val'));
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
