<?php

namespace App\Orchid\Screens\BusinessCards;

use App\Models\Blog\Post;
use App\Orchid\Layouts\BusinessCards\BusinessCardListLayout;
use App\Orchid\Layouts\Pages\PageListLayout;
use App\Orchid\Layouts\Posts\PostListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class BusinessCardsList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Бизнес карточки';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список бизнес карточек';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $result = Post::where('type', 'business_card')->orderBy('id', 'desc')->paginate(10);
        return ['business_card' => $result];
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
            BusinessCardListLayout::class,
        ];
    }
}
