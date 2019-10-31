<?php

namespace App\Http\Controllers;

use App\Models\Comment\Comment;
use App\Models\Common\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function get_comments(Request $request) {
        return response()->json(Comment::getViewTree($request));
    }

    public function add_comment(Request $request, $type) {
        $input = $request->all();

        $comment = new Comment();
        $comment->entry_id = (int) $input['comment_entry_id'];
        $comment->type = $type;
        $comment->message = strip_tags($input['message']);
        $comment->user_id = Auth::id() ?? 0;
        $comment->parent_id = $input['reply_to'] ?? null;
        $comment->root_parent_id = $input['root_reply_to'] ?? null;
        $comment->rating = $input['rating'] ?? 0;
        $comment->is_moderated = Settings::get('comments_moderation', 0);
        $comment->save();

        if ($type == 'realty') {
//            "select `advertisement_entry`.`author_id`, ROUND(AVG(`comments`.`rating`), 2) `avg_ratings`
//            from `comments`
//            inner join `advertisement_entry` on `advertisement_entry`.`id` = `comments`.`entry_id`
//            where `comments`.`is_moderated` = 0
//            group by `advertisement_entry`.`author_id`"
        }

        $html = view('comment.comment', ['comment' => $comment, 'class' => ($comment->root_parent_id ? 'comment-reply-1' : ''), 'root_parent_id' => ($comment->root_parent_id ? $comment->root_parent_id : $comment->id)])->render();

        echo json_encode(['toast' => 'Комментарий успешно добавлен', 'html' => $html]);
    }

}
