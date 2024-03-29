$(function () {
    $('.realty-single-photo').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: false,
        swipe: false,
        prevArrow: '<div class="realty-single-photo-prev"><i class="lh-icon lh-icon-arrow-left"></i></div>',
        nextArrow: '<div class="realty-single-photo-next"><i class="lh-icon lh-icon-arrow-right"></i></div>',
    });

    $('.realty-single-photo-nav').slick({
        slidesToShow: window.realty_slides,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.realty-single-photo',
        focusOnSelect: true,
        draggable: false,
        swipe: false,
    });

    window.show_user_number = false;
    $('.show-user-number').click(function () {
        if (window.show_user_number) {
            return false;
        }

        window.show_user_number = true;

        var that = this;
        $.ajax({
            url: '/cabinet/phone?id=' + $(this).attr('data-id'),
            dataType: "json",
            success: function (result) {
                if ('phone' in result) {
                    $(that).text(result.phone);
                    $(that).addClass('no-pointer');
                    $(that).off('click');
                }
            }
        }).always(function() {
            window.show_user_number = false;
        });
    });
})
