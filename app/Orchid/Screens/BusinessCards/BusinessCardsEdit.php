<?php

namespace App\Orchid\Screens\BusinessCards;

use App\Models\Blog\Cats;
use App\Models\Blog\Meta;
use App\Models\Blog\Post;
use App\Models\Blog\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

class BusinessCardsEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование бизнес карты';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Post $business_card
     *
     * @return array
     */
    public function query(Post $business_card = null): array
    {
        return [
            'business_card' => $business_card,
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
                    Input::make('business_card.title')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title('Заголовок'),

                    TinyMCE::make('business_card.content')
                        ->height('500px')
                        ->required()
                        ->title('Содержание')
                        ->theme('modern'),

                    Input::make('business_card.meta.cost')
                        ->type('text')
                        ->max(20)
                        ->title('Стоимость')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'cost');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Select::make('business_card.meta.card_position')
                        ->options([
                            'left' => 'Слева',
                            'right' => 'Справа',
                        ])
                        ->title('Позиция')
                        ->help('На сайте отображается последняя ОПУБЛИКОВАННАЯ запись по этой позиции')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'card_position');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Select::make('business_card.status')
                        ->options([
                            'draft' => 'Черновик',
//                                    'protected' => 'Опубликовать с доступ только по ссылке',
                            'trash' => 'Удален',
                            'published' => 'Опубликован',
                        ])
                        ->title('Статус публикации'),
                ]),
            ]),
        ];
    }

    /**
     * @param Post $business_card
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Post $business_card, Request $request)
    {
        $attributes = $request->get('business_card');

        if (!$business_card->exists) {
            $business_card = new Post;
        }

        // Меняем основную инфу
        $business_card->title = $attributes['title'] ?? '';
        $business_card->type = 'business_card';
        $business_card->status = $attributes['status'] ?? null;
        $business_card->content = $attributes['content'] ?? '';
        $business_card->save();

        // Обновляем META поля
        if (isset($attributes['meta'])) {
            foreach ($attributes['meta'] as $type => $meta) {
                $business_card->meta()->where('field', $type)->delete();
                if ($meta) {
                    Meta::updateOrCreate([
                        'entry_id' => $business_card->id,
                        'field' => $type,
                        'value' => $meta
                    ]);
                }
            }
        }

        Alert::info(__('business_card was saved'));

        return redirect()->route('platform.screens.business.edit', $business_card->id);
    }

    /**
     * @param Post $business_card
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Post $business_card)
    {
//        $business_card->term->delete();
        $business_card->delete();

        Alert::info(__('business_card was removed'));

        return redirect()->route('platform.screens.business.list');
    }
}