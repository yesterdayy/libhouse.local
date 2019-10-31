<?php

namespace App\Orchid\Screens\Pages;

use App\Models\Blog\Cats;
use App\Models\Blog\Meta;
use App\Models\Blog\page;
use App\Models\Blog\Post;
use App\Models\Blog\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\PictureUpload;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PagesEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование страницы';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Post $page
     *
     * @return array
     */
    public function query(Post $page = null): array
    {
        return [
            'page' => $page,
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
        if ($this->arguments[0]->meta()->where('field', 'page_type')->count() > 0 && $this->arguments[0]->meta()->where('field', 'page_type')->first()->value == 'main_page') {
            $prepend_slug = null;
        } else {
            $prepend_slug = 'blog/';
        }

        $page_main_layout = [
            Layout::columns([
                Layout::rows([
                    PictureUpload::make('page.cover')
                        ->width(1280)
                        ->height(500)
                        ->title('Обложка записи')
                        ->value(function ($value) {
                            $file = $value->first();
                            if (isset($file) && !empty($file)) {
                                $path = '/storage/' . $file->path . '/';
                                $filename = $file->name . '.' . $file->extension;
                                return $path . $filename;
                            } else {
                                return false;
                            }
                        }),
                ]),
            ]),
            Layout::columns([
                Layout::columns([
                    'Под обложкой лево' => [
                        Layout::rows([
                            Select::make('page.status')
                                ->options([
                                    'draft' => 'Черновик',
//                                    'protected' => 'Опубликовать с доступ только по ссылке',
                                    'trash' => 'Удален',
                                    'published' => 'Опубликован',
                                ])
                                ->title('Статус публикации'),
                        ]),
                    ],
                    'Под обложкой центр' => [
                        Layout::rows([
                            RadioButtons::make('page.meta.template')
                                ->options([
                                    '' => 'Обычный',
                                    'simple' => 'Упрощенный',
                                ])
                                ->title('Тип записи')
                                ->modifyValue(function ($value) {
                                    $meta = $this->arguments[0]->meta()->where('field', 'template');
                                    return ($meta->count() > 0 ? $meta->first()->value : '');
                                }),
                        ]),
                    ],
                ]),
                Layout::columns([
                    'Под обложкой право' => [
                        Layout::rows([
                            RadioButtons::make('page.meta.color')
                                ->options([
                                    '' => 'Обычный',
                                    'yellow' => 'Желтый',
                                    'black' => 'Черный',
                                    'blue' => 'Синий',
                                    'violet' => 'Фиолетовый',
                                ])
                                ->setClasses([
                                    'btn-bg-page-default',
                                    'btn-bg-page-yellow',
                                    'btn-bg-page-black',
                                    'btn-bg-page-blue',
                                    'btn-bg-page-violet',
                                ])
                                ->title('Цвет публикации')
                                ->modifyValue(function ($value) {
                                    $meta = $this->arguments[0]->meta()->where('field', 'color');
                                    return ($meta->count() > 0 ? $meta->first()->value : '');
                                }),
                        ]),
                    ]
                ]),
            ]),
            Layout::columns([
                Layout::rows([
                    Input::make('page.title')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title('Заголовок'),

                    Input::make('page.meta.subtitle')
                        ->type('text')
                        ->max(255)
                        ->title('Подзаголовок')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'subtitle');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Input::make('page.slug')
                        ->type('text')
                        ->max(255)
                        ->title(__('Slug'))
                        ->prepend($prepend_slug)
                        ->value(function ($value) {
                            return (is_string($value) ? preg_replace('/^blog[\/]?/', '', $value) : null);
                        }),

                    TinyMCE::make('page.content')
                        ->height('500px')
                        ->required()
                        ->title('Содержание')
                        ->theme('modern'),

                    DateTimer::make('page.publicated_at')
                        ->type('text')
                        ->title('Дата публикации')
                        ->enableTime(true)
                        ->format24hr(true)
                        ->format('Y-m-d H:i'),

                    \Orchid\Screen\Fields\Tags::make('page.tags.')
                        ->title('Теги'),

                    Upload::make('page.files')
                        ->title('Вложения'),

                ]),
            ]),
        ];

        $page_seo_layout = [
            Layout::columns([
                Layout::rows([
                    Input::make('page.meta.meta_title')
                        ->type('text')
                        ->max(255)
                        ->title('Заголовок')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'meta_title');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Input::make('page.meta.meta_description')
                        ->type('text')
                        ->max(140)
                        ->title('Краткое содержание страницы (макс 140 символов)')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'meta_description');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Input::make('page.meta.meta_keywords')
                        ->type('text')
                        ->max(500)
                        ->title('Ключевые слова (через запятую)')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'meta_keywords');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),
                ]),
            ]),
        ];

        $page_settings_layout = [
            Layout::columns([
                Layout::rows([
                    RadioButtons::make('page.meta.page_type')
                        ->title('Тип страницы')
                        ->options([
                            '' => 'Обычная страницы',
                            'main_page' => 'Главная страница',
                            'blog_page' => 'Страница блога'
                        ])
                        ->setClasses(['col-md-2', 'col-md-2', 'col-md-2'])
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'page_type');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),
                ]),
            ]),
        ];

        $layout = [
            Layout::tabs([
                'Запись' => $page_main_layout,
                'SEO' => $page_seo_layout,
                'Настройки' => $page_settings_layout,
            ])
        ];

        return $layout;
    }

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules($request): array
    {
        $validator = Validator::make($request->all(), [
            'page.slug' => 'required|max:255|regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_]+$/',
        ]);

        return $validator->validate();
    }

    /**
     * @param page $page
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Post $page, Request $request)
    {
        $this->rules($request);

        $attributes = $request->get('page');

        if (!$page->exists) {
            $page = new Post;
        }

        // Меняем основную инфу
        $page->title = $attributes['title'] ?? '';
        $page->type = 'page';
        $page->status = $attributes['status'] ?? null;
        if (isset($attributes['meta']['page_type']) && $attributes['meta']['page_type'] == 'main_page') {
            $page->slug = null;
        } else if (isset($attributes['meta']['page_type']) && $attributes['meta']['page_type'] == 'blog_page') {
            $page->slug = 'blog';
        } else {
            $page->slug = $attributes['slug'] ? 'blog/' . $attributes['slug'] : 'blog/' . Str::slug($attributes['title']);
        }
        $page->content = $attributes['content'] ?? '';
        $page->publicated_at = Carbon::parse(strtotime($attributes['publicated_at'] ?? date('Y-m-d H:i:s')));
        $page->save();

        // Добавляем категории
        $page->cats_rs()->delete();
        if (isset($attributes['cats'])) {
            foreach ($attributes['cats'] as $cat) {
                $page->cats_rs()->create(['entry_id' => $page->id, 'cat_id' => $cat]);
            }
        }

        // Добавляем теги
        $page->tags_rs()->delete();
        if (isset($attributes['tags'])) {
            $tags = [];
            foreach ($attributes['tags'] as $tag) {
                // Если существует
                if (is_numeric($tag)) {
                    $tmp_tag = [
                        'id' => $tag,
                    ];
                }
                // Иначе создаем поэтому передаем данные для создания
                else {
                    $tmp_tag = [
                        'name' => $tag,
                        'slug' => Str::slug($tag)
                    ];
                }
                $tags[] = Tags::updateOrCreate($tmp_tag);
            }
            unset($tag);

            if (isset($tags) && !empty($tags)) {
                foreach ($tags as $tag) {
                    $page->tags_rs()->create(['entry_id' => $page->id, 'tag_id' => $tag->id]);
                }
            }
        }

        // Обновляем META поля
        if (isset($attributes['meta'])) {
            foreach ($attributes['meta'] as $type => $meta) {
                $page->meta()->where('field', $type)->delete();
                if ($meta) {
                    switch ($type) {
                        case 'page_type':
                            Meta::where('field', 'page_type')->where('value', $meta)->delete();
                            Meta::updateOrCreate([
                                'entry_id' => $page->id,
                                'field' => $type,
                                'value' => $meta
                            ]);
                            break;
                        default:
                            Meta::updateOrCreate([
                                'entry_id' => $page->id,
                                'field' => $type,
                                'value' => $meta
                            ]);
                            break;
                    }
                }
            }
        }

        // Обновляем изображение обложки
        if (strpos($attributes['cover'], '#') !== false) {
            $page->cover_rs()->delete();
            if (isset($attributes['cover'])) {
                $cover_id = last(explode('#', $attributes['cover']));
                $page->files_rs()->create(['entry_id' => $page->id, 'type' => 'cover', 'attachment_id' => $cover_id]);
            }
        }

        // Обновляем файлы
        $page->files_rs()->delete();
        if (isset($attributes['files'])) {
            foreach ($attributes['files'] as $file) {
                $page->files_rs()->create(['entry_id' => $page->id, 'type' => 'files', 'attachment_id' => $file]);
            }
        }

        Alert::info(__('page was saved'));

        return redirect()->route('platform.screens.pages.edit', $page->id);
    }

    /**
     * @param Post $page
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Post $page)
    {
//        $page->term->delete();
        $page->delete();

        Alert::info(__('page was removed'));

        return redirect()->route('platform.screens.pages.list');
    }
}