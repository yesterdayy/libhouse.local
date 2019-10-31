<?php

namespace App\Models\Blog;

use App\Models\Common\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;

class Page extends Model
{
    protected $table = 'blog_entry';

    private static $shortcode_args;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('post_type', function (Builder $builder) {
            $builder->where('type', 'page');
        });
    }

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

        $result = self::postLoop($posts, $template);
        return $result;
    }

    private static function getSimplePosts($args) {
        $type = (isset($args['type']) ? $args['type'] : 'post');
        $posts = Post::where('type', $type);

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
                    $meta_table = Meta::getTableName();
                    $posts = $posts->join("{$meta_table}", "{$meta_table}.entry_id", 'id');
                    $posts = $posts->where("{$meta_table}.field", 'counter');
                    $posts = $posts->orderByRaw("ROUND((UNIX_TIMESTAMP() - UNIX_TIMESTAMP(`created_at`)) / {$meta_table}.`value`) asc");
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
            $post = Post::where('id', $id)->first();
        } else {
            $post = Post::where('slug', $id)->first();
        }
        if (!$post) {
            return null;
        }

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
        return view('blog.templates.single');
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
        $limit = 1;
        $page = (Request::input('page') ? Request::input('page') : 1);
        $posts = $posts->paginate($limit);

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

        $content .= view($template['loop'], compact(
            'posts'
            , 'is_pagination'
            , 'template'
            , 'page'
            , 'limit'
            , 'is_paginate'
            , 'args'
            , 'shortcode_args'
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
    public static function postDataFormat($post) {
        $attachments = self::getAttachesAssoc($post->attachments());
        $post->cover = (isset($attachments->cover) ? head($attachments->cover) : null);
        $post->attach_images = (isset($attachments->image) ? $attachments->image : null);
        $post->attach_documents = (isset($attachments->document) ? $attachments->document : null);
        $post->attach_types = (isset($attachments->types) ? $attachments->types : null);
        $post->meta_data = $post->meta->keyBy('field');
        $post->template = (isset($post->meta_data['template']) ? $post->meta_data['template']->value : 'default');

        return $post;
    }

    // Раскидываем файлы поста по соответствующим ассоциативным свойствам
    private static function getAttachesAssoc($attaches) {
        $attachments = [];
        foreach ($attaches as $attachment) {
            $attachment->date = date('Y-m-d', strtotime($attachment->created_at));
            $attachments[$attachment->type][] = $attachment;

            // Для быстрого поиска по типам файла (для дизайна)
            if ($attachment->type == 'files') {
                $ext = last(explode('.', $attachment->filename));
                $attachments['types'][$ext] = 1;
            }
        }
        $attachments = (object) $attachments;
        return $attachments;
    }

    /**
     * Метод для составление краткого описания
     * с удаление последнего слова, если оно не осталось полностью после обрезки
     */
    public static function getExcerpt($string, $length) {
        $excerpt = (mb_strlen($string) > $length ? mb_substr($string, 0, $length) : $string);
        if (preg_match('/[а-яА-ЯёЁa-zA-Z]/', mb_substr($string, $length, $length + 1))) {
            $excerpt = preg_replace('/[а-яА-ЯёЁa-zA-Z]+$/u', '', $excerpt);
        }
        return $excerpt;
    }

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function attachments()
    {
        return $this->hasMany('App\Models\Blog\Attachments', 'entry_id', 'id')->get();
    }

    public function cats()
    {
        return $this->belongsToMany('App\Models\Blog\Cats', 'blog_entry_cats', 'entry_id', 'cat_id');
    }

    public function meta()
    {
        return $this->hasMany('App\Models\Blog\Meta', 'entry_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\Tags', 'blog_entry_tags', 'entry_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment\Comment', 'entry_id', 'id');
    }

    public function author()
    {
        return $this->hasOne('App\Models\User\User', 'id', 'author_id');
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
