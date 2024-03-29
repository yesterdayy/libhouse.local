<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Comments;

use App\Models\Blog\Comment;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class CommentsEdit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'comments';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'User Comments';

    /**
     * Query data.
     *
     * @param \App\Models\Blog\Comment $comment
     *
     * @return array
     */
    public function query(Comment $comment): array
    {
        return [
            'comment' => $comment,
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
            Layout::wrapper('admin.comments.comment_edit', [
                'form' => [
                    Layout::rows([
                        Switcher::make('comment.is_moderated')
                            ->title('Статус модерации (отклонен / опубликован)'),
                    ]),
                ],
            ]),
        ];
    }

    /**
     * @param Comment $comment
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Comment $comment, Request $request)
    {
        $comment
            ->fill($request->get('comment'))
            ->save();

        Alert::info(__('Comment was saved'));

        return redirect()->route('platform.systems.comments');
    }

    /**
     * @param Comment $comment
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Comment $comment)
    {
        $comment->delete();

        Alert::info(__('Comment was removed'));

        return redirect()->route('platform.systems.comments');
    }
}
