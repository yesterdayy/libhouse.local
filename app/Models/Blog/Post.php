<?php

namespace App\Models\Blog;

use App\Models\Common\Settings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Post extends Model
{
    protected $table = 'blog_entry';
    protected static $static_table = 'blog_entry';
    protected static $static_popular_table = 'blog_popular_index';

    private static $shortcode_args;

    protected $appends = [
        'text'
    ];

    /**
     * Главная страница блога
     * или заданная станица или первая попавшаяся
     */
    public static function getHomePage() {
        $post = Settings::get('home_page');
        if (!empty($post)) {
            $post = Post::find($post);
        } else {
            $post = Post::first();
        }
        $GLOBALS['page'] = $post;
        return $post;
    }

    /**
     * Вызов главной страницы блога (не single page макет)
     */
    public static function blogMainPage() {
        return view('blog.main_page');
    }

    /**
     * AJAX подгрузка постов
     */
    public static function getPosts($args, $template = null) {
        foreach ($args as $k => $arg) {
            $args[$k] = trim(strip_tags($arg));
        }

        if (!$template || !isset($template['loop']) || empty($template['loop'])) {
            $template['loop'] = 'blog.post_loop';
        }

        if (isset($args['related']) && $args['related']) {
            $posts = self::getRelatedPosts($args);
        }
        else {
            $posts = self::getSimplePosts($args);
        }

        if ($posts->count() === 0) {
            if (Request::ajax()) {
                return json_encode([
                    'content' => '',
                    'is_paginate' => false,
                ]);
            } else {
                return null;
            }
        }

        $result = self::postLoop($posts, $template);
        return $result;
    }

    private static function getSimplePosts($args) {
        $type = (isset($args['type']) ? $args['type'] : 'post');
        $posts = Post::where('type', $type);
        $posts = $posts->where('status', 'published');

        if (isset($args['cat']) && !empty($args['cat'])) {
            $args['cat'] = explode(',', $args['cat']);
            $posts = $posts->whereHas('cats', function ($query) use ($args) {
                $query->whereIn('id', $args['cat']);
            });
        }

        if (isset($args['tag']) && !empty($args['tag'])) {
            $args['tag'] = explode(',', $args['tag']);
            $posts = $posts->whereHas('tags', function ($query) use ($args) {
                $query->whereIn('id', $args['tag']);
            });
        }

        if (isset($args['sort'])) {
            switch ($args['sort']) {
                case 'date':
                    $posts = $posts->orderBy('id', 'desc');
                    break;

                case 'popular':
                    $posts = $posts->join(self::$static_popular_table, self::$static_popular_table.'.entry_id', self::$static_table.'.id')
                             ->orderBy('date', 'desc')
                             ->orderBy('index', 'desc')
                             ->orderBy('publicated_at', 'desc');
                    break;

                case 'default':
                    $posts = $posts->orderBy('id', 'desc');
                    break;
            }
            $posts = $posts->orderBy('id', 'desc');
        } else {
            $posts = $posts->orderBy('id', 'desc');
        }

        return $posts;
    }

    private static function getRelatedPosts($args) {
        $current_post = Post::find($args['id']);
        $cats = [];
        foreach ($current_post->cats as $cat) {
            $cats[] = $cat->id;
        }

        $tags = [];
        foreach ($current_post->tags as $tag) {
            $tags[] = $tag->id;
        }

        $related_posts = Post::whereHas('cats', function ($query) use ($cats, $args) {
            $query->whereIn('id', $cats)->where('entry_id', '!=', $args['id']);
        })->whereHas('tags', function ($query) use ($tags, $args) {
            $query->whereIn('tag_id', $tags)->where('entry_id', '!=', $args['id']);
        })->orderBy('id', 'asc')->take(3);

        return $related_posts;
    }

    /**
     * Single вид поста
     */
    public static function getSingle($id) {
        if (is_numeric($id)) {
            $post = Post::where('id', $id);
        } else {
            $post = Post::where('slug', $id);
        }

        $post = $post->where('status', 'published')->where('publicated_at', '<=', Carbon::now())->first();

        if (!$post) {
            return null;
        }

        $GLOBALS['page'] = $post;

        $post = self::postDataFormat($post);

        if (isset($post->meta_data['counter'])) {
            $counter = $post->meta_data['counter'];
            $counter->increment('value');
            $counter->save();
        } else {
            $counter = new Meta(['field' => 'counter', 'value' => 1]);
            $post->meta()->save($counter);
        }

        $GLOBALS['post'] = $post;

        if ($post->type == 'page' && $post->meta()->where('field', 'template')->count() > 0) {
            return view('blog.templates.' . $post->meta()->where('field', 'template')->first()->value);
        } else {
            return view('blog.templates.single');
        }
    }

    /*
     * *******************************************************
     * Вспомогательные функции
     * *******************************************************
     */

    // Загрузка изображений
    public static function upload($type) {
        $file = Input::file($type);
        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $path = public_path() . '/upload/post/' . date('Y-m-d') . '/';
            $filename = str_random();
            $image_sizes = unserialize(Settings::get('thumbnails_size'));

            if (empty($image_sizes)) {
                $image_sizes = config('filesystems.thumbnails_size');
            }

            if (!file_exists($path)) {
                mkdir($path, 665, true);
            }

            if ($image_sizes) {
                foreach ($image_sizes as $image_size) {
                    $image_size = $image_size['value'];
                    Image::make($file)->encode('jpg')->fit($image_size[0], $image_size[1])->blur(20)->save($path . $filename . '_' . implode('_', $image_size) . '_preload.' . $ext, 25);
                    Image::make($file)->encode('jpg')->fit($image_size[0], $image_size[1])->save($path . $filename . '_' . implode('_', $image_size) . '.' . $ext, 80);
                }
            }

            Image::make(Input::file($type))->save($path . $filename . '.' . Input::file($type)->getClientOriginalExtension(), 80);
        }
    }

    /**
     * Функция цикла вывода постов с форматированием полей в удобном виде
     * @param $posts - ORM запрос без вызова take/get/all, чтобы взять и count и посты
     * @param string $template_loop - ссылка на post_loop шаблон
     * @param string $template_cat - папка с которой брать шаблоны постов (по умолчанию blog)
     * к примеру если template_cat = blog, то шаблоны постов будут брать из blog/templates/post_{meta_template}
     * @return string
     * @throws \Throwable
     */
    private static function postLoop($posts, $template = null) {
        if (!isset($template['loop']) || empty($template['loop'])) {
            $template['loop'] = 'blog.post_loop';
        }
        if (!isset($template['cat']) || empty($template['loop'])) {
            $template['cat'] = 'blog.templates.post';
        }
        if (!isset($template['default_post_template'])) {
            $template['default_post_template'] = null;
        }

        $count = $posts->count();
        $limit = 2;
        $page = (Request::input('page') ? Request::input('page') : 1);
        $posts = $posts->paginate($limit);
        $posts = $posts->merge($posts);

        $content = '';
        $tmp_post = null;
        foreach ($posts as $k => $post) {
            $post = self::postDataFormat($post);
        }

        $GLOBALS['posts'] = $posts;

        $ajax = Request::ajax();
        $is_paginate = $limit * $page < $count;

        $shortcode_args = self::$shortcode_args;
        $args = shortcode_args_to_string(self::$shortcode_args);
        $used_space = Request::input('used_space') ?? 0;
        $unique_id = Str::random();

        $content .= view($template['loop'], compact(
            'posts'
            , 'is_pagination'
            , 'template'
            , 'page'
            , 'limit'
            , 'is_paginate'
            , 'args'
            , 'shortcode_args'
            , 'used_space'
            , 'unique_id'
            ))->render();

        if ($ajax) {
            return json_encode([
                'content' => $content,
                'is_paginate' => $is_paginate,
            ]);
        } else {
            return $content;
        }
    }

    // Форматирование поста перед передачей на view
    private static function postDataFormat($post) {
        $post->meta_data = $post->meta->keyBy('field');
        $post->template = (isset($post->meta_data['template']) ? $post->meta_data['template']->value : 'default');
        return $post;
    }

    /**
     * Метод для составление краткого описания
     * с удаление последнего слова, если оно не осталось полностью после обрезки
     */
    public static function getExcerpt($string, $length) {
        $string = strip_tags($string);
        $excerpt = (mb_strlen($string) > $length ? mb_substr($string, 0, $length) : $string);
        if (preg_match('/[а-яА-ЯёЁa-zA-Z]/', mb_substr($string, $length, $length + 1))) {
            $excerpt = preg_replace('/[а-яА-ЯёЁa-zA-Z]+$/u', '', $excerpt);
        }
        return $excerpt;
    }

    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function cover()
    {
        return $this->belongsToMany('App\Models\Blog\Attachments', 'blog_entry_attachments', 'entry_id', 'attachment_id')->where('type', 'cover')->orderBy('sort', 'asc');
    }

    public function cover_rs()
    {
        return $this->hasMany('App\Models\Blog\AttachmentsRS', 'entry_id', 'id')->where('type', 'cover');
    }

    public function files()
    {
        return $this->belongsToMany('App\Models\Blog\Attachments', 'blog_entry_attachments', 'entry_id', 'attachment_id')->where('type', 'files')->orderBy('sort', 'asc');
    }

    public function files_rs()
    {
        return $this->hasMany('App\Models\Blog\AttachmentsRS', 'entry_id', 'id')->where('type', 'files');
    }

    public function cats()
    {
        return $this->belongsToMany('App\Models\Blog\Cats', 'blog_entry_cats', 'entry_id', 'cat_id');
    }

    public function cats_rs()
    {
        return $this->hasMany('App\Models\Blog\CatsRS', 'entry_id', 'id');
    }

    public function meta()
    {
        return $this->hasMany('App\Models\Blog\Meta', 'entry_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\Tags', 'blog_entry_tags', 'entry_id', 'tag_id');
    }

    public function tags_rs()
    {
        return $this->hasMany('App\Models\Blog\TagsRS', 'entry_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment\Comment', 'entry_id', 'id');
    }

    public function author()
    {
        return $this->hasOne('App\Models\User\User', 'id', 'author_id');
    }

    public function popular()
    {
        return $this->hasOne('App\Models\Blog\Popular', 'entry_id', 'id');
    }

    /*
     * *******************************************************
     * Shortcodes
     * *******************************************************
     */

    // Шорткод на вызов view главной страницы блога
    public static function blog_content_shortcode($args) {
        return self::blogMainPage();
    }

    // Шорткод на вывод постов
    public static function post_list_shortcode($args) {
        self::$shortcode_args = $args;
        $result = self::getPosts($args, ['loop' => "shortcodes.blog.post_list"]);
        return $result;
    }

    // Шорткод на вывод похожих записей
    public static function related_posts_shortcode($args) {
        self::$shortcode_args = $args;
        if (!isset($args['id']) || empty($args['id'])) {
            return null;
        }

        $args['related'] = true;

        $result = self::getPosts($args, [
            'loop' => "shortcodes.blog.widget.related.post_list_related",
            'cat' => "blog.widget.post_related",
            'default_post_template' => "related_default",
        ]);
        return $result;
    }

}
