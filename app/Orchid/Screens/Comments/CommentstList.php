<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Comments;

use App\Models\Comment\Comment;
use App\Orchid\Layouts\Comments\CommentsListLayout;
use Orchid\Screen\Screen;

class CommentstList extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Comments';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'User Comments';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $comments = Comment::latest()->paginate();

        return [
            'comments' => $comments,
        ];
    }

    /**
     * Button commands.
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            CommentsListLayout::class,
        ];
    }
}
