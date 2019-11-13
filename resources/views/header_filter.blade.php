<form class="adv-form-header" action="{{ route('realty.search') }}" method="get">
    <div class="row no-gutters mx-auto header-filter" rel='popover'>
        <div class="d-table w-100">
            <div class="d-table-row header-filters-wrap">
                <div class="adv-address-popup header-filter-with-label header-filter-with-address">
                    <div class="header-filter-label">Город, адрес, метро, район, ж/д, шоссе или ЖК</div>
                    <input type="text" name="address" class="header-address-input autocomplete-input" placeholder="Введите город, улица" value="{{ $filter['address'] ?? '' }}">
                    <input type="hidden" name="header_address_city" value="{{ $filter['address_city'] ?? '' }}">
                    <input type="hidden" name="header_address_street" value="{{ $filter['address_street'] ?? '' }}">
                    <i class="lh-icon lh-icon-select-arrow"></i>
                </div>

                <div class="adv-rent-type-popup header-filter-with-select" rel='popover'>
                    <div>{{ $filter['trade_name'] ?? 'Купить' }}</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="trade_type">

                    <div class="header-rent-types d-none">
                        <ul class="header-filter-simple-list">
                            @foreach ($realty_trade_types as $realty_trade_type)
                                <li data-val="{{ $realty_trade_type->id }}">{{ $realty_trade_type->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="adv-type-popup header-filter-with-select" rel='popover'>
                    <div>{{ $filter['type_name'] ?? 'Квартиру' }}</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="type" value="{{ isset($filter['type']) ? implode(',', $filter['type']) : '' }}">

                    <div class="header-types d-none">
                        <div>
                            <div class="header-filter-label-popup">Жилая</div>
                            <ul class="header-filter-multi-list">
                                @foreach ($realty_types as $adv_type)
                                    @if ($adv_type->commercy == 0)
                                        <li data-val="{{ $adv_type->id }}" {!! isset($filter['type']) && in_array($adv_type->id, $filter['type']) ? 'class="active"' : '' !!}>{{ $adv_type->name }}</li>
                                    @endif
                                @endforeach
                            </ul>

                            <div class="header-filter-label-popup">Коммерческая</div>
                            <ul class="header-filter-multi-list">
                                @foreach ($realty_types as $adv_type)
                                    @if ($adv_type->commercy == 1)
                                        <li data-val="{{ $adv_type->id }}" {!! isset($filter['type']) && in_array($adv_type->id, $filter['type']) ? 'class="active"' : '' !!}>{{ $adv_type->name }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="adv-floors-popup header-filter-with-select" rel='popover'>
                    <div>{{ $filter['room_type_name'] ?? 'Комнат' }}</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="room_type" value="{{ $filter['room_type'] ? implode(',', $filter['room_type']) : '' }}">

                    <div class="header-floors d-none">
                        <ul class="header-filter-simple-list with-checkboxes">
                            @foreach ($realty_room_types as $adv_room_type)
                                <li data-val="{{ $adv_room_type->id }}"><input type="checkbox" class="checkbox" id="room-type-{{ $adv_room_type->id }}" {{ isset($filter['room_type']) && in_array($adv_room_type->id, $filter['room_type']) ? 'checked' : '' }}><label for="room-type-{{ $adv_room_type->id }}">{{ $adv_room_type->name }}</label></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="adv-dop-type-popup header-filter-with-select" rel='popover'>
                    <div>{{ $filter['dop_type_name'] ?? 'Новостройка или вторичка' }}</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="dop_type">

                    <div class="header-dop-types d-none">
                        <div class="header-filter-label-popup">Категория</div>
                        <ul class="header-filter-simple-list">
                            @foreach ($realty_dop_types as $adv_dop_type)
                                <li data-val="{{ $adv_dop_type->id }}">{{ $adv_dop_type->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="header-filter-with-input">
                    <input type="text" name="price_start" placeholder="От" value="{{ $filter['price_start'] ?? '' }}">
                </div>

                <div class="header-filter-with-input">
                    <input type="text" name="price_end" placeholder="До" value="{{ $filter['price_end'] ?? '' }}">
                </div>
            </div>

            <div class="d-table-row">
                <button type="submit" class="btn btn-primary header-filter-submit">Найти <i class="lh-icon lh-icon-arrow-right lh-after"></i> </button>
            </div>
        </div>
    </div>
</form>
