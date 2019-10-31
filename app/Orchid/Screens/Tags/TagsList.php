<?php

namespace App\Orchid\Screens\Tags;

use App\Models\Blog\Cats;
use App\Models\Blog\Tags;
use App\Orchid\Layouts\Cats\CatEditLayout;
use App\Orchid\Layouts\Cats\CommentsListLayout;
use App\Orchid\Layouts\Tags\TagListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class TagsList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Категории';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список категорий';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $result = Tags::orderBy('id', 'desc')->paginate(10);
        return ['tags' => $result];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::name('Создать')->method('create'),
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
            TagListLayout::class,
        ];
    }
}
