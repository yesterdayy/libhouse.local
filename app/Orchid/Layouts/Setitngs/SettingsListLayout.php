<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Settings;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class SettingsListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'settings';

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
                ->render(function ($cats) {
                    return '<a href="'.route('platform.screens.menu.edit', $cats->id).'">'.$cats->name.'</a>';
                })
                ->sort(),
            TD::set('slug', 'URL')
                ->render(function ($cats) {
                    return $cats->slug;
                })
                ->sort(),
            TD::set('status', 'Статус')
                ->render(function ($cats) {
                    return ($cats->status == 1 ? 'Включена' : 'Отключена');
                })
                ->sort(),
        ];
    }
}
