<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Comments;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class CommentsListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'comments';

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
        $moderated_ru = [
            '-1' => 'Отклонен',
            '0' => 'Ожидает модерации',
            '1' => 'Опубликован',
        ];

        return [
            TD::set('id', 'ID')
                ->link('platform.screens.comments.edit', 'id', 'id')
                ->sort(),

            TD::set('entry', 'Заголовок поста')
                ->render(function ($comments) {
                    return '<a href="'.route('platform.screens.'.$comments->post->type.'s.edit', $comments->post->id).'">'.$comments->post->title.'</a>';
                })
                ->sort(),

            TD::set('message', 'Сообщение')
                ->sort(),

            TD::set('user', 'Автор')
                ->render(function ($comments) {
                    return $comments->author->name;
                })
                ->sort(),

            TD::set('created_at', 'Дата')
                ->sort(),

            TD::set('is_moderated', 'Дата')
                ->render(function ($comments) use ($moderated_ru) {
                    return $moderated_ru[$comments->is_moderated];
                })
                ->sort(),
            TD::set('actions', 'Действия')
                ->link('platform.screens.comments.edit', ['id'], '<i class="icon-pencil"></i>'),
        ];
    }
}
