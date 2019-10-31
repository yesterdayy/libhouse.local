<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Pages;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class PageListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'pages';

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
            TD::set('title', 'Заголовок')
                ->render(function ($pages) {
                    return '<a href="'.route('platform.screens.pages.edit', $pages->id).'">'.$pages->title.'</a>';
                })
                ->sort(),
            TD::set('slug', 'URL')
                ->render(function ($pages) {
                    return $pages->slug;
                })
                ->sort(),
            TD::set('type', 'Тип')
                ->render(function ($pages) {
                    return [
                        'draft' => 'Черновик',
                        'protected' => 'Доступ только по ссылке',
                        'trash' => 'Удален',
                        'published' => 'Опубликован',
                    ][$pages->status];
                })
                ->sort(),
            TD::set('updated_at', 'Дата изменения')
                ->render(function ($pages) {
                    return $pages->updated_at;
                })
                ->sort(),
            TD::set('author_id', 'Автор')
                ->render(function ($pages) {
                    return $pages->author_id;
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.pages.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
