<?php

namespace App\Orchid\Screens\Pages;

use App\Models\Blog\Post;
use App\Orchid\Layouts\Pages\PageListLayout;
use App\Orchid\Layouts\Posts\PostListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class PagesList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Страницы';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список страниц';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $result = Post::where('type', 'page')->orderBy('id', 'desc')->paginate(10);
        return ['pages' => $result];
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
            PageListLayout::class,
        ];
    }
}
