@component($typeForm,get_defined_vars())
    <div data-controller="menu-list-items fields--menu-list" class="menu-edit draggable-container" data-menu="{{ $value[0]->menu_id ?? null }}" @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
        @if ($value->count() > 0)
            @foreach($value as $menu_list)
                <div class="menu-list-item" data-id="{{ $menu_list->id }}">
                    <div class="pull-right small menu-list-show-detail"
                         data-target="fields--menu-list.toggle_menu_item"
                         data-action="click->fields--menu-list#toggle_menu_item">раскрыть</div>

                    <div class="form-group">
                        <label for="field-menuname">Пункт меню</label>
                        <input class="form-control menu-list-title" type="text" name="{{ $name }}[{{ $menu_list->id }}][title]" value="{{ $menu_list->title }}" required />
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="field-menuname">Выбрать страницу</label>
                            <select class="form-control menu-list-select-link select2-container">
                                @if ($menu_list->entry()->count() > 0)
                                    <option value="{{ $menu_list->entry->id }}" title="{{ $menu_list->entry->title }}">{{ $menu_list->entry->title }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-9">
                            <label for="field-menuname">Ссылка</label>
                            <input class="form-control menu-list-link" type="text" name="{{ $name }}[{{ $menu_list->id }}][link]" value="{{ $menu_list->link }}" />
                        </div>
                    </div>

                    <div class="menu-list-edit" style="display: none;">
                        <div class="form-group">
                            <label for="field-menuname">Иконка</label>
                            <input class="form-control menu-list-icon" type="text" name="{{ $name }}[{{ $menu_list->id }}][icon]" value="{{ $menu_list->icon }}" />
                        </div>

                        <div class="form-group">
                            <label for="field-menuname">CSS класс</label>
                            <input class="form-control menu-list-class" type="text" name="{{ $name }}[{{ $menu_list->id }}][class]" value="{{ $menu_list->class }}" />
                        </div>

                        <input class="menu-list-edit-order" type="hidden" name="{{ $name }}[{{ $menu_list->id }}][order]" />

                        <ul class="menu-list-edit-ul">
                            <li class="pull-right">
                                <a href="#"
                                   data-target="fields--menu-list.remove_menu_item"
                                   data-action="click->fields--menu-list#remove_menu_item">Удалить</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="menu-list-plus">
            <i class="btn btn-lg btn-primary btn-block icon-plus"
               data-target="fields--menu-list.add_menu_item"
               data-action="click->fields--menu-list#add_menu_item"></i>
            <div class="menu-list-plus-item" style="display: none;">
                <div class="menu-list-item-template" data-id="[newid]">
                    <div class="form-group">
                        <label>Пункт меню</label>
                        <input class="form-control menu-list-edit-title" type="text" name="{{ $name }}[new][newid][title]" required disabled />
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="field-menuname">Выбрать страницу</label>
                            <select class="form-control menu-list-select-link select2-container"></select>
                        </div>

                        <div class="col-md-9">
                            <label>Ссылка</label>
                            <input class="form-control menu-list-link" type="text" name="{{ $name }}[new][newid][link]" disabled />
                        </div>
                    </div>

                    <div class="menu-list-edit" style="display: none;">
                        <div class="form-group">
                            <label>Иконка</label>
                            <input class="form-control menu-list-edit-icon" type="text" name="{{ $name }}[new][newid][icon]" disabled />
                        </div>

                        <div class="form-group">
                            <label>CSS класс</label>
                            <input class="form-control menu-list-edit-class" type="text" name="{{ $name }}[new][newid][class]" disabled />
                        </div>

                        <input class="menu-list-edit-order" type="hidden" name="{{ $name }}[new][newid][order]" disabled />

                        <ul class="menu-list-edit-ul">
                            <li class="pull-right">
                                <a href="#"
                                   data-target="fields--menu-list.remove_menu_item"
                                   data-action="click->fields--menu-list#remove_menu_item">Удалить</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcomponent