<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{

    protected $table = 'blog_tags';

    public $timestamps = false;

    protected $fillable = array('name', 'slug');

    protected $appends = [
        'text'
    ];

    /**
     * Страница тега
     */
    public static function getTagPage($id) {
        if (is_numeric($id)) {
            $tag = Tags::where('id', $id)->first();
        } else {
            $tag = Tags::where('slug', $id)->first();
        }
        if (!$tag) {
            return null;
        }

        $post = (object) [
            'content' => '[post-list tag="'.$tag->id.'"]'
        ];

        return view('blog.index', ['post' => $post]);
    }

    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }

}
