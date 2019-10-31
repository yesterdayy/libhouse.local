<?php

namespace App\Orchid\Screens\Menu;

use App\Models\Blog\Cats;
use App\Models\Menu\Menu;
use App\Orchid\Layouts\Cats\CatEditLayout;
use App\Orchid\Layouts\Cats\CommentsListLayout;
use App\Orchid\Layouts\Menu\MenuListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class MenuList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Меню';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список меню';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $result = Menu::all();
        return ['menu' => $result];
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
            MenuListLayout::class,
        ];
    }
}
