<?php

namespace App\Orchid\Screens\Posts;

use App\Models\Blog\Cats;
use App\Models\Blog\Meta;
use App\Models\Blog\Popular;
use App\Models\Blog\Post;
use App\Models\Blog\Tags;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Orchid\Screen\Field;
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

class PostsEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование записи';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Post $post
     *
     * @return array
     */
    public function query(Post $post = null): array
    {
        return [
            'post' => $post,
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
        $post_main_layout = [
            Layout::columns([
                Layout::rows([
                    PictureUpload::make('post.cover')
                        ->width(1280)
                        ->height(500)
                        ->title('Обложка записи')
                        ->value(function ($value) {
                            $file = $value->first();
                            if (isset($file) && !empty($file)) {
                                $path = '/storage/' . $file->path . '/';
                                $filename = $file->name . '.' . $file->extension . '#' . $file->id;
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
                            Select::make('post.status')
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
                            RadioButtons::make('post.meta.template')
                                ->options([
                                    '' => 'Обычный',
                                    'wide' => 'Широкий',
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
                            RadioButtons::make('post.meta.color')
                                ->options([
                                    '' => 'Обычный',
                                    'yellow' => 'Желтый',
                                    'black' => 'Черный',
                                    'blue' => 'Синий',
                                    'violet' => 'Фиолетовый',
                                ])
                                ->setClasses([
                                    'btn-bg-post-default',
                                    'btn-bg-post-yellow',
                                    'btn-bg-post-black',
                                    'btn-bg-post-blue',
                                    'btn-bg-post-violet',
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
                    Input::make('post.title')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title('Заголовок'),

                    Input::make('post.slug')
                        ->type('text')
                        ->max(255)
                        ->title(__('Slug'))
                        ->prepend('blog/')
                        ->value(function ($value) {
                            return preg_replace('/^blog[\/]?/', '', $value);
                        }),

                    TinyMCE::make('post.content')
                        ->height('500px')
                        ->required()
                        ->title('Содержание')
                        ->theme('modern'),

                    DateTimer::make('post.publicated_at')
                        ->type('text')
                        ->title('Дата публикации')
                        ->enableTime(true)
                        ->format24hr(true)
                        ->format('Y-m-d H:i'),

                    Select::make('post.cats.')
                        ->fromModel(Cats::class, 'name')
                        ->multiple()
                        ->title('Категории'),

                    \Orchid\Screen\Fields\Tags::make('post.tags.')
                        ->title('Теги'),

                    Upload::make('post.files')
                        ->title('Вложения')
                        ->maxFiles(1),
                ]),
            ]),
        ];

        $post_seo_layout = [
            Layout::columns([
                Layout::rows([
                    Input::make('post.meta.meta_title')
                        ->type('text')
                        ->max(255)
                        ->title('Заголовок')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'meta_title');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Input::make('post.meta.meta_description')
                        ->type('text')
                        ->max(140)
                        ->title('Краткое содержание страницы (макс 140 символов)')
                        ->modifyValue(function ($value) {
                            $meta = $this->arguments[0]->meta()->where('field', 'meta_description');
                            return ($meta->count() > 0 ? $meta->first()->value : '');
                        }),

                    Input::make('post.meta.meta_keywords')
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

        $layout = [
            Layout::tabs([
                'Запись' => $post_main_layout,
                'SEO' => $post_seo_layout,
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
            'post.slug' => 'required|max:255|regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_]+$/',
        ]);

        return $validator->validate();
    }

    /**
     * @param Post $post
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Post $post, Request $request)
    {
        $this->rules($request);

        $attributes = $request->get('post');

        if (!$post->exists) {
            $post = new Post;
        }
        else {
            // Проверяем наличие slug в базе
            if (Post::where('slug', 'blog/' . $attributes['slug'] ?? Str::slug($attributes['title']))->whereIn('status', ['published', 'protected'])->where('id', '<>', $post->id)->count() > 0) {
                Alert::error(__('Запись с таким URL уже существует'));
                return redirect()->route('platform.screens.posts.edit', $post->id);
            }

            // Если опубликованному посту изменяют дату публикации то это новый пост
            if (strtotime($post->publicated_at) <= time() && strtotime($attributes['publicated_at']) > time()) {
                $post->status = 'history';
                $post->save();

                $data = $request->all();
                $data['post']['meta']['post_parent'] = $post->id;
                $request->merge($data);
                return $this->save(new Post, $request);
            }
        }

        // Меняем основную инфу
        $post->title = $attributes['title'] ?? '';
        $post->type = 'post';
        $post->status = $attributes['status'] ?? null;
        $post->slug = $attributes['slug'] ? 'blog/' . $attributes['slug'] : 'blog/' . Str::slug($attributes['title']);
        $post->content = $attributes['content'] ?? '';
        $post->publicated_at = Carbon::parse(strtotime($attributes['publicated_at'] ?? date('Y-m-d H:i:s')));
        $post->author_id = Auth::id();
        $post->save();

        // Добавляем категории
        $post->cats()->sync($attributes['cats'] ?? []);

        // Добавляем теги
        if (isset($attributes['tags'])) {
            $tags = [];
            foreach ($attributes['tags'] as $tag) {
                // Если существует
                if (is_numeric($tag)) {
                    $tags[] = $tag;
                }
                // Иначе создаем поэтому передаем данные для создания
                else {
                    $tmp_tag = [
                        'name' => $tag,
                        'slug' => Str::slug($tag)
                    ];
                    $tags[] = Tags::updateOrCreate($tmp_tag)->id;
                }
            }
            unset($tag);

            $post->tags()->sync($tags ?? []);
        }

        // Обновляем META поля
        if (isset($attributes['meta'])) {
            foreach ($attributes['meta'] as $type => $meta) {
                $post->meta()->where('field', $type)->delete();
                if ($meta) {
                    Meta::updateOrCreate([
                        'entry_id' => $post->id,
                        'field' => $type,
                        'value' => $meta
                    ]);
                }
            }
        }

        $post->files()->detach();
        // Обновляем изображение обложки
        $post->files()->attach(isset($attributes['cover']) && strpos($attributes['cover'], '#') !== false ? [last(explode('#', $attributes['cover'])) => ['type' => 'cover']] : []);

        // Обновляем файлы
        if (isset($attributes['files'])) {
            $files = [];
            foreach ($attributes['files'] as $k => $file) {
                $files[$file] = ['type' => 'files'];
            }
        }
        $post->files()->attach($files ?? []);

        Alert::info(__('Post was saved'));

        return redirect()->route('platform.screens.posts.edit', $post->id);
    }

    /**
     * @param Post $post
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Post $post)
    {
        $post->delete();

        Alert::info(__('Post was removed'));

        return redirect()->route('platform.screens.posts.list');
    }
}
