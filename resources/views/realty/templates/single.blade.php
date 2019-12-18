@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    <script> window.realty_slides = '{{ get_realty_photos($realty)->count() }}'; </script>
    {{ Html::script('js/single.min.js') }}

    <div class="realty-breadcrumbs-wrap row">
        <div class="col-md-9">
            {!! get_breadcrumbs($realty) !!}
        </div>

        <div class="col-md-3">
            {!! get_realty_nav($realty_next) !!}
        </div>
    </div>

    <article class="realty-single">
        <div class="row">
            <div class="col-md-9">
                <h1 class="realty-title">{{ $realty->title }}</h1>
            </div>

            <div class="col-md-3">
                <ul class="realty-info float-right">
                    <li class="realty-counter"><i class="lh-icon lh-icon-eye"></i>{{ $realty->counters->counter }}</li>
                    <li class="realty-date float-right">{{ get_locale_date($realty->created_at, 'd F') }}</li>
                </ul>
            </div>
        </div>

        @if ($realty->is_favorite)
            <div class="realty-favorite-btn single active" data-id="{{ $realty->id }}"><i class="lh-icon lh-icon-heart"></i><span>В избранном</span></div>
        @else
            <div class="realty-favorite-btn single" data-id="{{ $realty->id }}"><i class="lh-icon lh-icon-heart"></i><span>Добавить в избранное</span></div>
        @endif

        @if (get_realty_photos($realty)->count() > 0)
            <div class="realty-single-photo">
                @foreach (get_realty_photos($realty) as $photo)
                    <div class="realty-img"><img data-lazy="{{ get_image_thumbnail_url($photo, 'slide-wide') }}" /></div>
                @endforeach
            </div>

            <div class="realty-single-photo-nav">
                @foreach (get_realty_photos($realty) as $photo)
                    <div class="realty-img"><img data-lazy="{{ get_image_thumbnail_url($photo, 'slide-thumb') }}" /></div>
                @endforeach
            </div>
        @endif

        @if ($realty_info_table->count() > 0)
            <div class="realty-margin-btm">
                @include('realty.components.realty_info_table', ['realty_info_table' => $realty_info_table])
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
            {{ $realty->content }}
        </div>

        @if (isset($realty_info['youtube']))
            <div class="realty-video realty-margin-btm">
                @if (is_array($realty_info['youtube']))
                    @foreach ($realty_info['youtube'] as $video)
                        <div class="form-group"><iframe width="560" height="315" src="{{ $video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                    @endforeach
                @else
                    <div class="form-group"><iframe width="560" height="315" src="{{ $realty_info['youtube'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                @endif
            </div>
        @endif
    </article>
@endsection

@section('sidebar')
    <div class="realty-sidebar-info">
        <div class="realty-sidebar-price">{{ $realty->price }} {{ $realty->trade_type_id == 1 ? '₽/мес.' : '₽' }}</div>
        @if (isset($realty_info['with_communal']))
            <div class="realty-sidebar-communal">Коммунальные услуги включены</div>
        @endif

        <div class="realty-sidebar-user-info">
            <div class="realty-sidebar-user-name"><i class="lh-icon lh-icon-user"></i> <a href="{{ route('cabinet', ['id' => $realty->author->id]) }}">{{ $realty->author->first_name }}</a></div>
            <div class="realty-sidebar-user-type">{{ $realty->author->realty_type->name }}</div>
            <div class="realty-sidebar-user-created">На LIBHouse с {{ get_locale_date($realty->author->created_at, 'd.m.Y') }}</div>

            <div class="btn btn-default show-user-number" data-id="{{ $realty->author->id }}">Показать телефон</div>
        </div>
    </div>
@endsection
