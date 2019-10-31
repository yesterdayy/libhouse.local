<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Tags;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class TagListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'tags';

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
                ->render(function ($tags) {
                    return '<a href="'.route('platform.screens.tags.edit', $tags->id).'">'.$tags->name.'</a>';
                })
                ->sort(),
            TD::set('slug', 'URL')
                ->render(function ($tags) {
                    return $tags->slug;
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.tags.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
