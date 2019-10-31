<?php

namespace App\Orchid\Screens\Cats;

use App\Models\Blog\Cats;
use App\Orchid\Layouts\Cats\CatListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class CatsList extends Screen
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
        $result = Cats::orderBy('id', 'desc')->paginate(10);
        return ['cats' => $result];
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
            CatListLayout::class,
        ];
    }
}
