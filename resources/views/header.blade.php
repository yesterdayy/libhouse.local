<div class="header">
    <div class="row no-gutters header-top-wrap">
        <div class="col-md-6 text-left">
            <div class="current-city-wrap">
                <i class="lh-icon lh-icon-place"></i> <span class="current-city">{{ $city }}</span>
            </div>
        </div>

        <div class="col-md-6 text-right">
            @if (auth()->check())
                <ul class="header-profile-menu">
                    <li><a href="{{ route('cabinet', ['id' => auth()->id()]) }}"><i class="lh-icon lh-icon-user"></i> <span>Личный кабинет</span></a></li>
                    <li><a href="{{ route('logout') }}"><span>Выйти</span></a></li>
                </ul>
            @else
                <ul class="header-profile-menu">
                    <li><a href="{{ route('login') }}"><i class="lh-icon lh-icon-user"></i> <span>Войти</span></a></li>
                </ul>
            @endif
        </div>

        <div class="city-pick-modal d-none">
            <div class="form-group">
                <select name="pick_address" class="form-control address-pick"><option value="">Введите регион или город</option> </select>
            </div>

            @foreach($popular_cities as $popular_city_items)
                <div class="col-city" style="width: <?= round(100 / count($popular_cities), 1) ?>%">
                    <ul class="popup-after-list popular-cities-pick">
                        @foreach($popular_city_items as $popular_city)
                            <li data-val="{{ $popular_city->NAME }}"><a href="#">{{ $popular_city->NAME }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        @if (!cookie('city'))
            <div class="city-question-popup" style="display: none;">
                <div class="popup-question">Ваш город - <b>{{ $city }}</b></div>
                <div class="popup-group-btn text-center">
                    <div class="btn btn-primary city-question-yes" data-val="{{ $city }}">Да</div>
                    <div class="btn btn-simple city-question-no">Выбрать другой</div>
                </div>
            </div>
        @endif

        <script>
            $(function () {
                $('.city-question-yes').click(function () {
                    $(this).closest('.city-question-popup').remove();
                    $.cookie('city', $(this).attr('data-val'));
                });

                $('.city-question-no').click(function () {
                    $.cookie('city', 'none');
                    $(this).closest('.city-question-popup').remove();
                    let content = $('.city-pick-modal');
                    content.removeClass('d-none');
                    let modal = {
                        title: 'Выберите регион или город',
                        content: content[0],
                    };
                    show_modal(modal);
                });

                setTimeout(function () {
                    $('.city-question-popup').fadeIn(300);
                }, 500);
            });
        </script>
    </div>

    <div class="row no-gutters header-middle-wrap">
        <div class="col-md-2">
            <img src="" width="215px" height="30px" />
        </div>

        <div class="col-md-7">
            {!! get_menu('header', ['ul_class' => 'header-menu left grt-menu', 'li_class' => 'header-menu-item']) !!}
        </div>

        <div class="col-md-3 text-right">
            <ul class="header-additional-menu">
                <li><i class="lh-icon lh-icon-search"></i></li>
                <li><i class="lh-icon lh-icon-heart"></i></li>
                <li><a href="{{ route('realty.create') }}" class="btn btn-primary">+ Добавить объявление</a></li>
            </ul>
        </div>
    </div>

    <div class="header-bottom-wrap text-center">
        <div class="header-title">Найди свое жилье на LibHouse</div>

        @include('header_filter')
    </div>
</div>
