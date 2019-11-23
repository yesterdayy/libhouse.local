$(function () {
    $('.adv-form-header').submit(function (e) {
        if (location.href.indexOf('/realty/search') != -1) {
            e.preventDefault();
            var that = this;

            $.ajax({
                url: $(this).attr('action'),
                type: 'GET',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function(result) {
                    if (result.html.length > 0) {
                        $('.wrap-content').html(result.html);
                        let new_url = location.origin + location.pathname + '?' + $(that).serialize();
                        history.pushState({}, null, new_url);
                    }
                }
            });
        } else {

        }
    });

    $(document).on('click', '.filter-sort-pick li', function () {
        let value = $(this).attr('data-val');
        $('.adv-form-header input[name=sort]').val(value);
        $(this).closest('.popover').popover('hide');

        $('.adv-form-header').submit();
    });

    $(document).on('click', '.remove-filter', function () {
        if ($(this).parent().attr('data-type') == 'multiple') {
            var value = $(this).parent().attr('data-value');

            var text_elem = $('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').parent().find('div[data-chars]');
            var value_text = [];

            // Если хоть раз открывали popover
            if ($($('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').parent().popover().data('bs.popover').tip).length > 0) {
                if ($('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').val() == value) {
                    $('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').val(null);
                } else {
                    let old_value = $('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').val().split(',');
                    delete(old_value[old_value.indexOf(value)]);

                    var that = this;
                    old_value.forEach(function (val) {
                        value_text.push($($('.adv-form-header input[name="' + $(that).parent().attr('data-field') + '"]').parent().popover().data('bs.popover').tip).find('[data-val="'+val+'"]').text().trim());
                    });

                    old_value = old_value.filter(Boolean).join(',');
                    $('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').val(old_value);

                    $($('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').parent().popover().data('bs.popover').tip).find('[data-val="'+value+'"] input[type=checkbox]').prop('checked', false);
                }

                text_elem.text(value_text.length > 0 ? value_text.join(',').substr(0, text_elem.attr('data-chars')) : text_elem.attr('data-default-text'));
            }
            else {
                $('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').parent().find('[data-val="' + value + '"]').click();
            }
        }
        else {
            if ($('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').length > 0) {
                $('.adv-form-header input[name="' + $(this).parent().attr('data-field') + '"]').val(null);
            }
        }

        $(this).parent().fadeOut(200);
        $('.adv-form-header').submit();
    });
});
