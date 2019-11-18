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
});
