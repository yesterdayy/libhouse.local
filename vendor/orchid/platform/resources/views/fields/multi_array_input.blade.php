@component($typeForm,get_defined_vars())
    <div data-controller="multi-array-list-items fields--multi-array-input" @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
        @if (isset($value))
            @foreach($value as $arr_items)
                <div class="multi-array-list-item">
                    <div class="multi-array-list-title">{{ $arr_items['name'] }} «<i>{{ $arr_items['slug'] }}</i>»</div>
                    <div class="btn btn-sm btn-warning multi-array-list-remove pull-right"
                         data-target="fields--multi-array-input.remove_array_list_item"
                         data-action="click->fields--multi-array-input#remove_array_list_item">Удалить</div>

                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="{{ $name }}[{{ $arr_items['slug'] }}][name]" class="form-control" value="{{ $arr_items['name'] }}">
                    </div>

                    <div class="form-group">
                        <label>Ярлык</label>
                        <input type="text" name="{{ $name }}[{{ $arr_items['slug'] }}][slug]" class="form-control" value="{{ $arr_items['slug'] }}">
                    </div>

                    @foreach($arr_items['value'] as $index => $item)
                        <div class="form-group">
                            <label>{{ $labels[$index] }}</label>
                            <input type="text" name="{{ $name }}[{{ $arr_items['slug'] }}][value][{{ $index }}]" class="form-control" value="{{ $item }}">
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="multi-array-list-item">
                <div class="multi-array-list-title"></div>
                <div class="btn btn-sm btn-warning multi-array-list-remove pull-right">Удалить</div>

                <div class="form-group">
                    <label>Название</label>
                    <input type="text" name="{{ $name }}[new][newid][name]" class="form-control multi-array-list-edit-title">
                </div>

                <div class="form-group">
                    <label>Ярлык</label>
                    <input type="text" name="{{ $name }}[new][newid][slug]" class="form-control multi-array-list-edit-slug">
                </div>

                @foreach($labels as $index => $curlabel)
                    <div class="form-group">
                        <label>{{ $curlabel }}</label>
                        <input type="text" name="{{ $name }}[new][newid][value][{{ $index }}]" class="multi-array-list-edit-parameters-{{ $index }} form-control">
                    </div>
                @endforeach
            </div>
        @endif

        <div class="multi-array-list-plus">
            <i class="btn btn-lg btn-primary btn-block icon-plus"
               data-target="fields--multi-array-input.add_array_list_item"
               data-action="click->fields--multi-array-input#add_array_list_item"></i>

            <div class="multi-array-list-item-template" style="display: none;">
                <div class="multi-array-list-title"></div>
                <div class="btn btn-sm btn-warning multi-array-list-remove pull-right"
                     data-target="fields--multi-array-input.remove_array_list_item"
                     data-action="click->fields--multi-array-input#remove_array_list_item">Удалить</div>

                <div class="form-group">
                    <label>Название</label>
                    <input type="text" name="{{ $name }}[new][newid][name]" class="form-control multi-array-list-edit-title" disabled>
                </div>

                <div class="form-group">
                    <label>Ярлык</label>
                    <input type="text" name="{{ $name }}[new][newid][slug]" class="form-control multi-array-list-edit-slug" disabled>
                </div>

                @foreach($labels as $index => $curlabel)
                    <div class="form-group">
                        <label>{{ $curlabel }}</label>
                        <input type="text" name="{{ $name }}[new][newid][value][{{ $index }}]" class="multi-array-list-edit-parameters-{{ $index }} form-control" disabled>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endcomponent