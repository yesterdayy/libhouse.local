<article class="{{ $widget_class }}-article realty-article {{ (isset($shortcode_args['template']) ? $shortcode_args['template'] : 'realty') }}-realty-template col-md-12">
    <div class="realty-border row no-gutters">
        <div class="col-compact-1">
            <a href="{{ get_realty_link($realty) }}">
                <div class="realty-photos">
                    @if (get_realty_photos($realty)->count() > 0)
                        @foreach (get_realty_photos($realty) as $photo)
                            @if ($loop->iteration > 5) @break @endif
                            <div class="realty-img"><img data-lazy="{{ get_image_thumbnail_url($photo, 'thumb-wide') }}" width="318px" height="198px" /></div>
                        @endforeach
                    @endif
                </div>
            </a>
        </div>

        <div class="col-compact-2">
            <div class="realty-content-wrap">
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

                <div class="realty-compact-info">
                    <span class="realty-city">{{ $realty->city }}</span> <span class="realty-price">{{ $realty->price }} {{ $realty->trade_type_id == 1 ? '₽/мес.' : '₽' }}</span>
                </div>
            </div>
        </div>

        <div class="col-compact-3 text-right realty-compact-actions">
            <div class="btn btn-lg btn-default show-user-number" data-id="{{ $realty->author->id }}">Показать телефон</div>

            <div class="compact-favorite">
                <div class="realty-favorite-btn text-right active" data-id="{{ $realty->id }}"><i class="lh-icon lh-icon-heart"></i><span>В избранном</span></div>
            </div>

            <div>
                <div class="realty-counter"><i class="lh-icon lh-icon-eye"></i>{{ isset($realty->counters) ? $realty->counters->counter : 0 }}</div>
                <div class="realty-date float-right">{{ get_locale_date($realty->created_at, 'j F') }}</div>
            </div>
        </div>
    </div>
</article>
