<?php

namespace App\Orchid\Screens\SiteReviews;

use App\Models\Blog\Post;
use App\Orchid\Layouts\Posts\PostListLayout;
use App\Orchid\Layouts\SiteReviews\SiteReviewsListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class SiteReviewsList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Отзывы';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список отзывов';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $result = Post::where('type', 'site_review')->orderBy('id', 'desc')->paginate(10);
        return ['site_reviews' => $result];
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
            SiteReviewsListLayout::class,
        ];
    }
}
