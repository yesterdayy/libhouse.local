<?php

namespace App\Models\Comment;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';

    protected $fillable = ['entry_id', 'type', 'message', 'user_id', 'parent_id', 'root_parent_id', 'is_moderated', 'rating'];

    protected static $comments_view = 'comment.comments';

    protected $perPage = 10;

    public static function getViewComments($entry_id, $type) {
        $comments = Comment::where('entry_id', $entry_id)->where('type', $type)->where('parent_id', null)->get();
        $comments_count = $comments->count();
        $comments_count += Comment::whereIn('root_parent_id', $comments->pluck('id'))->count();

        return view(self::$comments_view, compact('comments', 'comments_count'));
    }

    public static function getViewTree($request, $view = 'comment.comment') {
        $entry_id = $request->get('entry_id');

        if (empty($entry_id)) {
            return null;
        }

        $comments = Comment::where('entry_id', $entry_id)->where('parent_id', null)->paginate();

        $comments_view = '';

        $all_depth_parent_comments_tmp = Comment::whereIn('root_parent_id', $comments->pluck('id'))->orderBy('id', 'asc')->get();
        $all_depth_parent_comments = [];
        foreach ($all_depth_parent_comments_tmp as $parent_comment) {
            $all_depth_parent_comments[$parent_comment->root_parent_id][] = $parent_comment;
        }
        unset($all_depth_parent_comments_tmp, $parent_comment);

        foreach ($comments as $comment) {
            $comments_view .= view('comment.comment', ['comment' => $comment, 'root_parent_id' => $comment->id])->render();
            if (isset($all_depth_parent_comments[$comment->id])) {
                foreach ($all_depth_parent_comments[$comment->id] as $parent_comment) {
                    $comments_view .= view('comment.comment', ['comment' => $parent_comment, 'class' => 'comment-reply-1', 'root_parent_id' => $comment->id])->render();
                }
                unset($all_depth_parent_comments[$comment->id], $parent_comment);
            }
        }

        $result = [];
        $result['is_finished'] = ($comments->currentPage() == $comments->lastPage() ? 1 : 0);
        $result['comments_html'] = $comments_view;

        return $result;
    }

    public function getContent($field) {
        return $this->$field;
    }

    public static function user_comment_list_widget($shortcode_args) {
        $type = $shortcode_args['type'] ?? null;

        if (!$type) {
            return '';
        }

        $template = $shortcode_args['templage'] ?? 'list';
        $start = $shortcode_args['start'] ?? 0;
        $limit = $shortcode_args['limit'] ?? 10;
        $author_id = $shortcode_args['author_id'] ?? null;
        $ajax_url = $shortcode_args['ajax_url'] ?? null;

        $comments = null;
        if ($author_id) {
            $comments = Comment::with($type)->whereHas($type, function ($query) use ($author_id) {
                $query->where('author_id', $author_id);
            })->where('type', $type)->where('is_moderated', 0)->orderBy('id', 'desc')->offset($start)->take($limit)->get();
            if ($comments->count() === 0) {
                $comments = null;
            }
        }

        $data = compact(
            'comments',
            'args',
            'limit',
            'author_id',
            'ajax_url'
        );

        return view('/shortcodes/comment/' . $template, $data)->render();
    }

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function author()
    {
        return $this->hasOne('App\Models\User\User', 'id', 'user_id');
    }

    public function post()
    {
        return $this->hasOne('App\Models\Blog\Post', 'id', 'entry_id');
    }

    public function realty()
    {
        return $this->hasOne('App\Models\Realty\Realty', 'id', 'entry_id');
    }

    public function entry()
    {
        switch ($this->type) {
            case 'post':
                return $this->post;
                break;

            case 'realty':
                return $this->realty;
                break;
        }
    }

    /*
     * *******************************************************
     * Shortcodes
     * *******************************************************
     */

    public static function comments_shortcode($args) {
        return (isset($args['id']) ? self::getViewComments($args['id'], $args['type']) : null);
    }

    // Виджет для вывода комментариев которые писали этому пользователя в его записях
    public static function user_comments_list_shortcode($args) {
        return self::user_comment_list_widget($args);
    }

}
