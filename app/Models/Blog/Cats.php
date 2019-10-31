<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cats extends Model
{

    protected $table = 'blog_cats';

    public $primaryKey = 'id';

    /**
     * Страница категории
     */
    public static function getCatPage($id) {
        if (is_numeric($id)) {
            $cat = Cats::where('id', $id)->first();
        } else {
            $cat = Cats::where('slug', $id)->first();
        }
        if (!$cat) {
            return null;
        }

        $post = (object) [
            'content' => '[post-list cat="'.$cat->id.'"]'
        ];

        return view('blog.index', ['post' => $post]);
    }

    public static function cats_list_shortcode($args) {
        if (isset($args['type'])) {
            $cats = Cats::where('status', 1)->where('type', $args['type'])->get();
            if (isset($args['with-count'])) {
                try {
                    $entry_counts = DB::select("SELECT 
                    CASE WHEN `cat`.cat_id IS NULL THEN 0 ELSE `cat`.cat_id END `category_id`, 
                    COUNT(*) `count`
                    FROM `{$args['type']}_entry` `entry`
                    LEFT JOIN `{$args['type']}_entry_cats` `cat` ON `cat`.entry_id = `entry`.id
                    WHERE `entry`.`status` = 'published'
                    GROUP BY `category_id`");
                    $entry_counts = array_column($entry_counts, 'count', 'category_id');

                    foreach ($cats as $cat) {
                        $cat->cnt = $entry_counts[$cat->id] ?? 0;
                    }
                } catch (\Exception $err) {

                }
            }
            $args = shortcode_args_to_string($args);
            return view('shortcodes.blog.cats_list', compact('cats', 'args'));
        } else {
            return '';
        }
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Blog\Post', 'blog_entry_cats', 'cat_id', 'entry_id');
    }

}
