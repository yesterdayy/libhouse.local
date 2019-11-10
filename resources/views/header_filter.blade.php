<form class="adv-form-header" action="{{ route('realty.search') }}" method="get">
    <div class="row no-gutters mx-auto header-filter" rel='popover'>
        <div class="d-table w-100">
            <div class="d-table-row header-filters-wrap">
                <div class="adv-address-popup header-filter-with-label header-filter-with-address">
                    <div class="header-filter-label">Город, адрес, метро, район, ж/д, шоссе или ЖК</div>
                    <input type="text" class="header-address-input" placeholder="Введите адрес">
                    <input type="hidden" name="address">
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <div class="header-address d-none">
                        <div class="header-filter-label-popup">адреса</div>
                        <ul class="header-filter-simple-list header-street"></ul>

                        <div class="header-filter-label-popup">город</div>
                        <ul class="header-filter-simple-list header-city"></ul>
                    </div>
                </div>

                <div class="adv-rent-type-popup header-filter-with-select" rel='popover'>
                    <div>Купить</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="service_type">

                    <div class="header-rent-types d-none">
                        <ul class="header-filter-simple-list">
                            @foreach ($realty_service_types as $realty_service_type)
                                <li data-val="{{ $realty_service_type->id }}">{{ $realty_service_type->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="adv-type-popup header-filter-with-select" rel='popover'>
                    <div>Квартиру</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="type[]">

                    <div class="header-types d-none">
                        <div class="header-filter-label-popup">Жилая</div>
                        <ul class="header-filter-multi-list">
                            @foreach ($realty_types as $adv_type)
                                @if ($adv_type->commercy == 0)
                                    <li data-val="{{ $adv_type->id }}">{{ $adv_type->name }}</li>
                                @endif
                            @endforeach
                        </ul>

                        <div class="header-filter-label-popup">Коммерческая</div>
                        <ul class="header-filter-multi-list">
                            @foreach ($realty_types as $adv_type)
                                @if ($adv_type->commercy == 1)
                                    <li data-val="{{ $adv_type->id }}">{{ $adv_type->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="adv-floors-popup header-filter-with-select" rel='popover'>
                    <div>Комнат</div>
                    <i class="lh-icon lh-icon-select-arrow"></i>

                    <input type="hidden" name="room_type[]">

                    <div class="header-floors d-none">
                        <ul class="header-filter-simple-list with-checkboxes">
                            @foreach ($realty_room_types as $adv_room_type)
                                <li data-val="{{ $adv_room_type->id }}"><input type="checkbox" class="checkbox" id="room-type-{{ $adv_room_type->id }}"><label for="room-type-{{ $adv_room_type->id }}">{{ $adv_room_type->name }}</label></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="adv-dop-type-popup header-filter-with-select" rel='popover'>
                    <div>Новостройка или вторичка</div>
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
                    <input type="text" name="price_start" placeholder="От">
                </div>

                <div class="header-filter-with-input">
                    <input type="text" name="price_end" placeholder="До">
                </div>
            </div>

            <div class="d-table-row">
                <button type="submit" class="btn btn-primary header-filter-submit">Найти <i class="lh-icon lh-icon-arrow-right lh-after"></i> </button>
            </div>
        </div>
    </div>
</form>
