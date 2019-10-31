<?php

namespace App\Orchid\Screens\Posts;

use App\Models\Blog\Post;
use App\Orchid\Layouts\Posts\PostListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class PostsList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Записи';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список записей';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $result = Post::where('type', 'post')->where('status', '!=', 'history')->orderBy('id', 'desc')->paginate(10);
        return ['posts' => $result];
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
            PostListLayout::class,
        ];
    }
}
