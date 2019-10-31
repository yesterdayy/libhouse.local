<?php

namespace App\Orchid\Screens\SiteReviews;

use App\Models\Blog\Cats;
use App\Models\Blog\Meta;
use App\Models\Blog\Post;
use App\Models\Blog\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\AvatarUpload;
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

class SiteReviewsEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование отзывов';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Post $site_reviews
     *
     * @return array
     */
    public function query(Post $site_reviews = null): array
    {
        return [
            'site_reviews' => $site_reviews,
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
                    AvatarUpload::make('site_reviews.cover')
                        ->width(150)
                        ->height(150)
                        ->title('Обложка записи')
                        ->value(function ($value) {
                            $file = $value->first();
                            if (isset($file) && !empty($file)) {
                                $path = '/storage/' . $file->path . '/';
                                $filename = $file->name . '.jpg';
                                return $path . $filename;
                            } else {
                                return false;
                            }
                        }),
                ]),

                Layout::rows([
                    Input::make('site_reviews.title')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title('ФИО клиента'),

                    Select::make('site_reviews.meta.source')
                        ->options([
                            'ТВИТЕР' => 'ТВИТЕР',
                            'FACEBOOK' => 'FACEBOOK',
                            'VK' => 'VK',
                            'ОК' => 'ОК',
                        ])
                        ->title('Источник')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'source');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Select::make('site_reviews.status')
                        ->options([
                            'draft' => 'Черновик',
//                                    'protected' => 'Опубликовать с доступ только по ссылке',
                            'trash' => 'Удален',
                            'published' => 'Опубликован',
                        ])
                        ->title('Статус публикации'),
                ]),
            ]),
            Layout::columns([
                Layout::rows([
                    TinyMCE::make('site_reviews.content')
                        ->height('500px')
                        ->required()
                        ->title('Содержание')
                        ->theme('modern'),
                ]),
            ]),
        ];
    }

    /**
     * @param Post $site_reviews
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Post $site_reviews, Request $request)
    {
        $attributes = $request->get('site_reviews');

        if (!$site_reviews->exists) {
            $site_reviews = new Post;
        }

        // Меняем основную инфу
        $site_reviews->title = $attributes['title'] ?? '';
        $site_reviews->type = 'site_review';
        $site_reviews->status = $attributes['status'] ?? null;
        $site_reviews->content = $attributes['content'] ?? '';
        $site_reviews->save();

        // Обновляем META поля
        if (isset($attributes['meta'])) {
            foreach ($attributes['meta'] as $type => $meta) {
                $site_reviews->meta()->where('field', $type)->delete();
                if ($meta) {
                    Meta::updateOrCreate([
                        'entry_id' => $site_reviews->id,
                        'field' => $type,
                        'value' => $meta
                    ]);
                }
            }
        }

        // Обновляем изображение обложки
        if (strpos($attributes['cover'], '#') !== false) {
            $site_reviews->cover_rs()->delete();
            if (isset($attributes['cover'])) {
                $cover_id = last(explode('#', $attributes['cover']));
                $site_reviews->files_rs()->create(['entry_id' => $site_reviews->id, 'type' => 'cover', 'attachment_id' => $cover_id]);
            }
        }

        Alert::info(__('Post was saved'));

        return redirect()->route('platform.screens.reviews.edit', $site_reviews->id);
    }

    /**
     * @param Post $site_reviews
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Post $site_reviews)
    {
//        $site_reviews->term->delete();
        $site_reviews->delete();

        Alert::info(__('Post was removed'));

        return redirect()->route('platform.screens.reviews.list');
    }
}
