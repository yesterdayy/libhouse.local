<div class="header">
    <div class="row wrap-default">
        <div class="col-md-2">
            <a href="/"><img src="/img/logo.png" width="100px" height="31px" class="logo" /></a>
        </div>

        <div class="col-md-3 text-left">
            <div class="current-city-wrap">
                <span class="current-city">{{ $city }}</span>
            </div>

            <div class="dropdown">
                <div class="dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">Аренда<span class="caret"></span>
                </div>
                <ul class="dropdown-menu animate__animated animate__pulse animate__faster">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li class="dropdown">
                        <a href="#">One more dropdown</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li class="dropdown">
                                <a href="#">One more dropdown</a>
                                <ul class="dropdown-menu">
                                    ...
                                </ul>
                            </li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Something else here</a></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <div class="dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">Продажа<span class="caret"></span>
                </div>
                <ul class="dropdown-menu animate__animated animate__pulse animate__faster">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li class="dropdown">
                        <a href="#">One more dropdown</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li class="dropdown">
                                <a href="#">One more dropdown</a>
                                <ul class="dropdown-menu">
                                    ...
                                </ul>
                            </li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Something else here</a></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>

            <style>
                .dropdown:hover>.dropdown-menu {
                    display: block;
                }

                .dropdown>.dropdown-toggle:active {
                    /*Without this, clicking will make it sticky*/
                // pointer-events: none;
                }

            </style>

            <div class="city-pick-modal d-none">
                <div class="form-group">
                    <input name="pick_address" type="text" class="form-control address-pick autocomplete-input" placeholder="Введите регион или город" />
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

            @if (!Cookie::has('city') && !isset($light_header))
                <div class="city-question-popup" style="display: none;">
                    <div class="popup-question">Ваш город - <b>{{ $city }}</b></div>
                    <div class="popup-group-btn text-center">
                        <div class="btn btn-primary city-question-yes" data-val="{{ $city }}">Да</div>
                        <div class="btn btn-simple city-question-no">Выбрать другой</div>
                    </div>
                </div>

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
            @endif
        </div>

        <div class="col-md-3 text-right">
            @if (auth()->check())
                <ul class="header-profile-menu">
                    <li><a href="{{ route('cabinet', ['id' => auth()->id()]) }}"><i class="lh-icon lh-icon-user"></i> <span>Личный кабинет</span></a></li>
                    <li><a href="{{ route('logout') }}"><span>Выйти</span></a></li>
                </ul>
            @else
                <ul class="header-profile-menu">
                    <li class="auth-login"><a href="#"><span>Войти</span></a></li>
                </ul>
            @endif
        </div>

        <div class="col-md-4 text-right">
            <ul class="header-additional-menu">
                @if (auth()->check())
                    <li><a href="{{ route('cabinet', ['id' => auth()->id()]) . '#favorite' }}"><i class="lh-icon lh-icon-heart"></i></a></li>
                @endif
                <li><a href="{{ route('realty.create') }}" class="btn btn-primary">Подать объявление</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="header-menu-wrap">
    {!! get_menu('header', ['ul_class' => 'header-menu left grt-menu wrap-default', 'li_class' => 'header-menu-item']) !!}
</div>

<div class="main-wrap wrap-default">
