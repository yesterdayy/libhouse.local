<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Posts;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class PostListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'posts';

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
                ->render(function ($posts) {
                    return '<a href="'.route('platform.screens.posts.edit', $posts->id).'">'.$posts->title.'</a>';
                })
                ->sort(),
            TD::set('slug', 'URL')
                ->render(function ($posts) {
                    return $posts->slug;
                })
                ->sort(),
            TD::set('cat', 'Категории')
                ->render(function ($posts) {
                    return ($posts->cats()->count() > 0 ? $posts->cats()->count() > 1 ? $posts->cats()->first()->name . '...' : $posts->cats()->first()->name : 'Без категории');
                })
                ->sort(),
            TD::set('type', 'Статус')
                ->render(function ($posts) {
                    return [
                        'draft' => 'Черновик',
                        'protected' => 'Доступ только по ссылке',
                        'trash' => 'Удален',
                        'published' => 'Опубликован',
                    ][$posts->status];
                })
                ->sort(),
            TD::set('updated_at', 'Дата изменения')
                ->render(function ($posts) {
                    return $posts->updated_at;
                })
                ->sort(),
            TD::set('author_id', 'Автор')
                ->render(function ($posts) {
                    return $posts->author->name;
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.posts.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
