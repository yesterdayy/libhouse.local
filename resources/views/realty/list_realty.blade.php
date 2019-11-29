<article class="{{ $widget_class }}-article col-md-4">
    <div class="realty-border">
        <a href="{{ get_realty_link($realty) }}">
            <div class="realty-photos">
                @if (get_realty_photos($realty)->count() > 0)
                    @foreach (get_realty_photos($realty) as $photo)
                        @if ($loop->iteration > 5) @break @endif
                        <div class="realty-img"><img data-lazy="{{ get_image_thumbnail_url($photo, 'thumb') }}" width="435px" height="348px" /></div>
                    @endforeach
                @endif
            </div>
        </a>

        <div class="realt-wrap">
            <div class="realty-title"><a href="{{ get_realty_link($realty) }}">{{ $realty->title }}</a></div>

            <div class="realty-square row no-gutters">
                @if (isset($realty->info_arr['square_common']))
                    <div class="col-md-4"><span>общ. пл.</span>{{ $realty->info_arr['square_common'] }} м<sup>2</sup></div>
                @endif

                @if (isset($realty->info_arr['square_living']))
                    <div class="col-md-4"><span>жил. пл.</span>{{ $realty->info_arr['square_living'] }} м<sup>2</sup></div>
                @endif

                @if (isset($realty->info_arr['square_kitchen']))
                    <div class="col-md-4"><span>кух. пл.</span>{{ $realty->info_arr['square_kitchen'] }} м<sup>2</sup></div>
                @endif
            </div>

            <div class="realty-footer-info row">
                <div class="col-md-6">
                    <div class="realty-price">{{ $realty->price }} {{ $realty->trade_type_id == 1 ? '₽/мес.' : '₽' }}</div>
                    <div class="realty-city">{{ $realty->city }}</div>
                </div>

                <div class="col-md-6 pl-0">
                    <div class="realty-favorite text-right"><i class="lh-icon lh-icon-heart"></i><span>Добавить в избранное</span></div>
                    <div class="realty-counter"><i class="lh-icon lh-icon-eye"></i>{{ $realty->counters->counter }}</div>
                    <div class="realty-date float-right">{{ get_locale_date($realty->created_at, 'j F') }}</div>
                </div>
            </div>
        </div>
    </div>
</article>
