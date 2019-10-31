<?php

namespace App\Orchid\Screens\Cats;

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
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CatsEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование категории';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Cats $cats
     *
     * @return array
     */
    public function query(Cats $cats = null): array
    {
        return [
            'cats' => $cats,
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
                    Input::make('cats.name')
                        ->type('text')
                        ->max(255)
                        ->required()
                        ->title('Заголовок'),

                    Input::make('cats.slug')
                        ->type('text')
                        ->max(255)
                        ->title(__('Slug')),
                ]),
            ]),
            Layout::columns([
                Layout::rows([
                    Switcher::make('cats.status')
                    ->title('Статус (выкл / вкл)')
                    ->value(true),
                ]),
                Layout::rows([
                ]),
                Layout::rows([
                ]),
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
            'cats.slug' => 'required|max:255|regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_]+$/',
        ]);

        return $validator->validate();
    }

    /**
     * @param Cats $cats
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Cats $cats, Request $request)
    {
        $this->rules($request);

        $attributes = $request->get('cats');

        if (!$cats->exists) {
            $cats = new Cats;
        }

        // Меняем основную инфу
        $cats->name = $attributes['name'] ?? '';
        $cats->slug = $attributes['slug'] ?? Str::slug($attributes['name']);
        $cats->status = isset($attributes['status']) ? 1 : 0;
        $cats->save();

        Alert::info(__('Cat was saved'));

        return redirect()->route('platform.screens.cats.edit', $cats->id);
    }

    /**
     * @param Post $post
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Cats $cats)
    {
        $cats->delete();

        Alert::info(__('Cat was removed'));

        return redirect()->route('platform.screens.cats.list');
    }
}
