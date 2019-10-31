<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\BusinessCards;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class BusinessCardListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'business_card';

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
                ->render(function ($business_cards) {
                    return '<a href="'.route('platform.screens.business.edit', $business_cards->id).'">'.$business_cards->title.'</a>';
                })
                ->sort(),
            TD::set('cost', 'Стоимость')
                ->render(function ($business_cards) {
                    $meta = $business_cards->meta()->where('field', 'cost');
                    return ($meta->count() > 0 ? '$ ' . $meta->first()->value : '');
                })
                ->sort(),
            TD::set('card_position', 'Позиция')
                ->render(function ($business_cards) {
                    $meta = $business_cards->meta()->where('field', 'card_position');
                    return ($meta->count() > 0 ? ['left' => 'Слева', 'right' => 'Справа'][$meta->first()->value] : '');
                })
                ->sort(),
            TD::set('type', 'Тип')
                ->render(function ($business_cards) {
                    return [
                        'draft' => 'Черновик',
                        'protected' => 'Доступ только по ссылке',
                        'trash' => 'Удален',
                        'published' => 'Опубликован',
                    ][$business_cards->status];
                })
                ->sort(),
            TD::set('author_id', 'Автор')
                ->render(function ($business_cards) {
                    return $business_cards->author_id;
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.business.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
