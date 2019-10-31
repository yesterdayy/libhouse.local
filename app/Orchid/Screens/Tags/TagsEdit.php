<?php

namespace App\Orchid\Screens\Tags;

use App\Models\Blog\Cats;
use App\Models\Blog\Meta;
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
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class TagsEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование тегов';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Tags $tags
     *
     * @return array
     */
    public function query(Tags $tags = null): array
    {
        return [
            'tags' => $tags,
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
            Layout::rows([
                Input::make('tags.name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title('Заголовок'),

                Input::make('tags.slug')
                    ->type('text')
                    ->max(255)
                    ->title(__('Slug')),
            ]),
        ];
    }

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules($request): array
    {
        $validator = Validator::make($request->all(), [
            'tags.slug' => 'required|max:255|regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_]+$/',
        ]);

        return $validator->validate();
    }

    /**
     * @param Tags $tags
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Tags $tags, Request $request)
    {
        $this->rules($request);

        $attributes = $request->get('tags');

        if (!$tags->exists) {
            $tags = new Tags;
        }

        // Меняем основную инфу
        $tags->name = $attributes['name'] ?? '';
        $tags->slug = $attributes['slug'] ?? Str::slug($attributes['name']);
        $tags->save();

        Alert::info(__('Tag was saved'));

        return redirect()->route('platform.screens.tags.edit', $tags->id);
    }

    /**
     * @param Post $post
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Tags $tags)
    {
//        $post->term->delete();
        $tags->delete();

        Alert::info(__('Tag was removed'));

        return redirect()->route('platform.screens.tags.list');
    }
}
