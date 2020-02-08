@extends('index_no_sidebar')

@section('content')
    <div class="cabinet-wrap row">
        <div class="col-md-3 cabinet-tab-list">
            <div class="cabinet-tab-title">Кабинет пользователя:</div>

            <div class="user-min-info cabinet-border-btm">
                <div class="user-min-avatar">
                    <img src="/img/no_ava.jpg" width="64px" height="64px" />
                </div>

                <div class="user-min-text">
                    <div class="user-min-name">{{ trim($user->last_name . ' ' . $user->first_name) }}</div>
                    <div class="user-min-id">ID {{ $user->id }}</div>
                </div>

                <div class="user-min-owner">{{ mb_strtolower($user->realty_type->name) }}</div>
            </div>

            <div class="cabinet-search cabinet-border-btm">
                {{ Form::open(['url' => route('cabinet.search', ['id' => $user->id]), 'class' => 'cabinet-search']) }}
                    <div class="position-relative">
                        {{ Form::text('term', null, ['class' => 'form-control cabinet-search-input', 'id' => 'cabinet-search', 'placeholder' => 'Поиск']) }}
                        <div class="lh-icon lh-icon-search cabinet-search-btn"></div>
                    </div>
                {{ Form::close() }}
            </div>

            <ul class="cabinet-menu cabinet-border-btm">
                <li><a href="#realty">Объявления</a></li>
                @if ($is_my_page)
                    <li><a href="#favorite">Избранное</a></li>
                @endif
{{--                <li><a href="#">Уведомления</a></li>--}}
{{--                <li><a href="#">Сообщения</a></li>--}}
                @if ($is_my_page)
                    <li><a href="#settings">Настройки</a></li>
                @endif
            </ul>

            @if ($is_my_page)
                <ul class="cabinet-menu">
                    <li><a href="{{ route('logout') }}">Выйти</a></li>
                </ul>
            @endif
        </div>

        <div class="col-md-9 cabinet-tab-wrap">
            <div class="cabinet-tab-title"></div>

            @if ($is_my_page)
                <ul class="realty-btn-filters" style="display: none;">
                    <li class="btn btn-default green" data-filter="active" tabindex="0">Активные<span class="btn-simple-badge">{{ $btn_filters_count['active'] }}</span></li>
                    <li class="btn btn-default gray" data-filter="no_active" tabindex="0">Неактивные<span class="btn-simple-badge">{{ $btn_filters_count['no_active'] }}</span></li>
                    <li class="btn btn-default red" data-filter="blocked" tabindex="0">Заблокированные<span class="btn-simple-badge">{{ $btn_filters_count['blocked'] }}</span></li>
                    <li class="btn btn-default blue" data-filter="draft" tabindex="0">На проверке<span class="btn-simple-badge">{{ $btn_filters_count['draft'] }}</span></li>
                </ul>
            @endif

            <div class="cabinet-tab-content"></div>
        </div>
    </div>

    <script>
        $('.cabinet-search-btn').click(function() {
            $(this).closest('form').submit();
        });

        $(document).off('click', '.cabinet-tab-content .page-link');
        $(document).on('click', '.cabinet-tab-content .page-link', function(e) {
            e.preventDefault();
            tab_ajax($(this).attr('href'));
        });

        $(function() {
            if (location.hash && $('[href="'+location.hash+'"]').length > 0) {
                $('[href="'+location.hash+'"]').closest('li').click();
            } else {
                $('.cabinet-menu li').eq(0).click();
            }
        });

        function tab_ajax(url) {
            $('.cabinet-tab-content').html('');

            var tab = $('.cabinet-menu > li.active a').attr('href').substr(1);

            if (typeof url === 'undefined') {
                url = '/cabinet/{{ $user->id }}/' + tab + ($('.realty-btn-filters li.active').length > 0 ? '?btn-filter=' + $('.realty-btn-filters li.active').attr('data-filter') : '');
            } else if (tab == 'realty') {
                url += ($('.realty-btn-filters li.active').length > 0 ? '&btn-filter=' + $('.realty-btn-filters li.active').attr('data-filter') : '');
            }

            $.ajax({
                type: 'GET',
                url: url,
                success: function (result) {
                    if (result.length > 0) {
                        $('.cabinet-tab-content').html(result);
                    } else {

                    }
                },
                error: function (result) {
                },
            });
        }

        $('.cabinet-search').submit(function (e) {
            e.preventDefault();
            e.stopPropagation();

            if (window.cabinet_search) {
                return false;
            }

            window.cabinet_search = true;

            $.ajax({
                url: $(this).attr('action'),
                type: 'GET',
                data: {
                    term: $('input[name=term]', this).val()
                },
                success: function (result) {
                    if (result.length > 0) {
                        $('.cabinet-tab-wrap .cabinet-tab-title').text('Поиск:' );
                        $('.cabinet-tab-content').html(result);
                        $('.cabinet-menu > li').removeClass('active');
                    }
                }
            }).always(function() {
                window.cabinet_search = false;
            });
        })

        $('.cabinet-menu > li').click(function (e) {
            // Скрываем / раскрываем фильтр по объявлениям
            if ($('a', this).attr('href').substr(1) == 'realty') {
                $('.cabinet-tab-wrap .realty-btn-filters').show();
            } else {
                $('.cabinet-tab-wrap .realty-btn-filters').hide();
            }

            $('.cabinet-tab-wrap .cabinet-tab-title').text($(this).text().trim() + ':');

            if ($(this).hasClass('active')) {
                return false;
            } else {
                $(this).closest('ul').find('li').removeClass('active');
                $(this).addClass("active");
            }
            tab_ajax();
        });
    </script>

    @if ($is_my_page)
        <script>
            $(document)
                .off('click', '.realty-btn-filters > li')
                .on('click', '.realty-btn-filters > li', function () {
                    if ($(this).hasClass('active')) {
                        $(this).closest('ul').find('li').removeClass('active');
                    } else {
                        $(this).closest('ul').find('li').removeClass('active');
                        $(this).addClass("active");
                    }
                    tab_ajax();
                });
        </script>
    @endif
@endsection
