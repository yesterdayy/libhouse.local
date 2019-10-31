<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\SiteReviews;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class SiteReviewsListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'site_reviews';

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
            TD::set('title', 'ФИО')
                ->render(function ($site_reviews) {
                    return '<a href="'.route('platform.screens.reviews.edit', $site_reviews->id).'">'.$site_reviews->title.'</a>';
                })
                ->sort(),
            TD::set('source', 'Источник')
                ->render(function ($site_reviews) {
                    $meta = $site_reviews->meta()->where('field', 'source');
                    return ($meta->count() > 0 ? $meta->first()->value : '');
                })
                ->sort(),
            TD::set('type', 'Статус')
                ->render(function ($site_reviews) {
                    return [
                        'draft' => 'Черновик',
                        'protected' => 'Доступ только по ссылке',
                        'trash' => 'Удален',
                        'published' => 'Опубликован',
                    ][$site_reviews->status];
                })
                ->sort(),
            TD::set('updated_at', 'Дата изменения')
                ->render(function ($site_reviews) {
                    return $site_reviews->updated_at;
                })
                ->sort(),
            TD::set('author_id', 'Автор')
                ->render(function ($site_reviews) {
                    return $site_reviews->author_id;
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.reviews.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
