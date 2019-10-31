<?php

namespace App\Orchid\Screens\Menu;

use App\Models\Menu\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\PictureUpload;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MenuEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование меню';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Menu $menu
     *
     * @return array
     */
    public function query(Menu $menu = null): array
    {
        return [
            'menu' => $menu,
        ];
    }

    /**
     * Button commands.
     *
     * @return array
     */
    public function commandBar(): array
    {
        return [
            Link::name(__('Save'))
                ->icon('icon-check')
                ->method('save'),

            Link::name(__('Remove'))
                ->icon('icon-trash')
                ->method('remove'),
        ];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::columns([
                Layout::rows([
                    Input::make('menu.name')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title(__('Название меню')),

                    Input::make('menu.alias')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title(__('Алиас меню')),

                    \Orchid\Screen\Fields\MenuList::make('menu.items')
                ]),
            ]),
        ];
    }

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules($request): array
    {
        $validator = Validator::make($request->all(), [
            'menu.alias' => 'required|max:255|regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_]+$/',
        ]);

        return $validator->validate();
    }

    /**
     * @param Menu $menu
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Menu $menu, Request $request)
    {
        $this->rules($request);

        $attributes = $request->get('menu');

        if (!$menu->exists) {
            $menu = new Menu;
            $menu_db_info = DB::select("SHOW TABLE STATUS LIKE '".$menu->getTable()."'");
            $menu_id = $menu_db_info[0]->Auto_increment;
        } else {
            $menu_id = $menu->id;
        }

        // Меняем основную инфу
        $menu->name = $attributes['name'] ?? '';
        $menu->alias = $attributes['alias'] ?? 'menu-' . $menu_id;
        $menu->save();

        // Обновляем меню
        foreach ($attributes['items'] as $menu_list_id => $menu_item) {
            if (strpos($menu_list_id, 'new') !== false) {
                foreach ($menu_item as $new_item) {
                    $menu->items()->create($new_item);
                }
            } else if (strpos($menu_list_id, 'delete') !== false) {
                $menu->items()->where('id', (last(explode('_', $menu_list_id))))->delete();
            } else {
                $menu->items()->where('id', $menu_list_id)->update($menu_item);
            }
        }

        Alert::info(__('Menu was saved'));

        return redirect()->route('platform.screens.menu.edit', $menu->id);
    }

    /**
     * @param Menu $menu
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Menu $menu)
    {
//        $menu->term->delete();
        $menu->delete();

        Alert::info(__('Menu was removed'));

        return redirect()->route('platform.screens.menus.list');
    }
}
