@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    <div class="row">
        <div class="col-md-6">
            {!! get_breadcrumbs($realty) !!}
        </div>

        <div class="col-md-6">
            @include('components.realty_nav')
        </div>
    </div>

    <article class="realty-single">
        <div class="row">
            <div class="col-md-9">
                <h1 class="realty-title">{{ $realty->title }}</h1>
            </div>

            <div class="col-md-3">
                <ul class="realty-info pull-right">
                    <li class="realty-counter"><i class="lh-icon lh-icon-eye"></i>1569</li>
                    <li class="realty-date float-right">{{ get_locale_date($realty->created_at, 'd F') }}</li>
                </ul>
            </div>
        </div>

        <div class="realty-favorite single"><i class="lh-icon lh-icon-heart"></i><span>Добавить в избранное</span></div>

        @if (get_realty_photos($realty)->count() > 0)
            <div class="realty-single-photo">
                @foreach (get_realty_photos($realty) as $photo)
                    <div class="realty-img"><img data-lazy="/storage/{{ $photo->path }}{{ $photo->name . '.' . $photo->extension }}" /></div>
                @endforeach
            </div>

            <div class="realty-single-photo-nav">
                @foreach (get_realty_photos($realty) as $photo)
                    <div class="realty-img"><img data-lazy="/storage/{{ $photo->path }}{{ $photo->name . '.' . $photo->extension }}" /></div>
                @endforeach
            </div>

            <script>
                $('.realty-single-photo').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: false,
                    swipe: false,
                    prevArrow: '<div class="realty-single-photo-prev"><i class="lh-icon lh-icon-arrow-left"></i></div>',
                    nextArrow: '<div class="realty-single-photo-next"><i class="lh-icon lh-icon-arrow-right"></i></div>',
                });

                $('.realty-single-photo-nav').slick({
                    slidesToShow: {{ get_realty_photos($realty)->count() }},
                    slidesToScroll: 1,
                    arrows: false,
                    asNavFor: '.realty-single-photo',
                    respondTo: 'slide',
                    focusOnSelect: true,
                    draggable: false,
                    swipe: false,
                });
            </script>
        @endif

        @if ($realty_info->count() > 0)
            <div class="realty-margin-btm">
                @include('realty.components.realty_info', ['realty_info' => $realty_info])
            </div>
        @endif

        <div class="realty-address realty-margin-btm">
            <b>Адрес:</b> Республика Крым, г. Симферополь, ул. Симферопольская 10
        </div>

        <div class="realty-comfort realty-margin-btm">
            @if (count($comforts) > 0)
                <div class="row checkbox-grid-wrap">
                    @foreach ($comforts as $cat_name => $comfort_cat)
                        <div class="checkbox-grid row no-gutters col-md-3">
                            {{ Form::label('comfort', $cat_name) }}

                            @foreach ($comfort_cat as $comfort)
                                <div>
                                    {{ Form::checkbox('comfort['.$comfort->id.']', null, isset($comfort->selected), ['id' => 'comfort-'.$comfort->id, 'class' => 'checkbox blue']) }}
                                    {{ Form::label(null, $comfort->name) }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="realty-content realty-margin-btm">
            Сдаю однокомнатную квартиру-студию, для женщины-девушки студентки, проживание без животных. К посредникам просьба не беспокоить. Мебель, быт. техника, газовая колонка, бойлер, новые радиаторы отопления.
        </div>
    </article>
@endsection

@section('sidebar')
    <div class="realty-sidebar-info">
        <div class="realty-sidebar-price">{{ $realty->price }} ₽/мес.</div>
        <div class="realty-sidebar-communal">Коммунальные услуги включены</div>
    </div>
@endsection
