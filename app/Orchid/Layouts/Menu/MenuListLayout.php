<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Menu;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class MenuListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'menu';

    /**
     * HTTP data filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            TD::set('name', 'Заголовок')
                ->render(function ($menu) {
                    return '<a href="'.route('platform.screens.menu.edit', $menu->id).'">'.$menu->name.'</a>';
                })
                ->sort(),
            TD::set('alias', 'Алиас')
                ->render(function ($menu) {
                    return $menu->alias;
                })
                ->sort(),
            TD::set('count', 'Кол-во пунктов')
                ->render(function ($menu) {
                    return $menu->items->count();
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.menu.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
