<?php

use App\Components\Shortcodes;
use App\Models\Comment\Comment;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\URL;
use Jenssegers\Date\Date;
use App\Models\Common\Settings;
use function Sodium\add;

/*
 * *******************************************************
 * Post хелперы
 * *******************************************************
 */

// Функция для while-цикла поста
if (! function_exists('loop_posts')) {

    function loop_posts() {
        global $posts;
        static $current_post_loop_index = 0;
        $post = $posts->get($current_post_loop_index);
        if (!$post) {
            unset($GLOBALS['posts'], $GLOBALS['post'], $current_post_loop_index);
            return null;
        }
        $GLOBALS['post'] = $post;
        $current_post_loop_index++;
        return $post;
    }

}

// Функция для while-цикла поста DERKACH
if (! function_exists('loop_posts_derkach')) {

    function loop_posts_derkach($used_space = 0) {
        global $posts;
        static $current_post_loop_index = 0;
        if ($current_post_loop_index === 0) {
            $GLOBALS['prev_used_space'] = 0;
            $GLOBALS['used_space'] = $used_space;
        }
        $post = $posts->get($current_post_loop_index);
        if (!$post) {
            unset($GLOBALS['posts'], $GLOBALS['post'], $GLOBALS['used_space'], $current_post_loop_index);
            return null;
        }
        $GLOBALS['post'] = $post;
        $GLOBALS['used_space'] = $current_post_loop_index === 0 ? $used_space : $GLOBALS['prev_used_space'];
        $GLOBALS['prev_used_space'] = (get_post_meta('thumb_type') ? $GLOBALS['used_space'] + 2 : $GLOBALS['used_space'] + 1);
        $current_post_loop_index++;
        return $post;
    }

}

// Функция для закидывания $post в глобальную переменную
if (! function_exists('get_post')) {

    function get_post() {
        global $posts;
        global $current_post_loop_index;

        if (isset($posts) && isset($current_post_loop_index)) {
            $GLOBALS['post'] = $posts->get($current_post_loop_index);
        }
    }

}

// ID поста
if (! function_exists('get_post_id')) {

    function get_post_id() {
        global $post;
        return $post->id;
    }

}

// Заголовок поста
if (! function_exists('get_post_title')) {

    function get_post_title() {
        global $post;
        return (isset($post->title) ? $post->title : null);
    }

}

// Ссылка поста
if (! function_exists('get_post_link')) {

    function get_post_link() {
        global $post;
        return (isset($post->slug) ? url($post->slug) : null);
    }

}

// Краткое описание поста
if (! function_exists('get_post_excerpt')) {

    function get_post_excerpt($length = 180) {
        global $post;
        if (isset($post->content)) {
            return Post::getExcerpt($post->content, $length);
        } else {
            return null;
        }
    }

}

// Полное описание поста
if (! function_exists('get_post_content')) {

    function get_post_content() {
        global $post;
        return shortcodes_parse($post->content);
    }

}

// Получение изображения поста
if (! function_exists('get_post_thumbnail')) {

    function get_post_thumbnail($size, $lazy = true) {
        global $post;

        if ($post->cover()->count() > 0) {
            $cover = $post->cover()->first();
            $size = Settings::getUnserialize('thumbnails_size')[$size]['value'];

            if ($size) {
                $size = implode('_', $size);
                $path = '/storage/' . $cover->path;

                $filename = $cover->name;
                $filename_preload = $path . $filename . '_' . $size . '_preload.jpg';
                $filename_lazy = $path . $filename . '_' . $size . '.jpg';

                if ($lazy) {
                    return "<img src='$filename_preload' data-src='$filename_lazy' class='image-lazy'/>";
                } else {
                    return "<img src='$filename_lazy'/>";
                }
            } else {
                return null;
            }
        }
    }

}

// Получение изображения поста
if (! function_exists('get_post_thumbnail_url')) {

    function get_post_thumbnail_url($size) {
        global $post;

        if (isset($post) && $post->cover()->count() > 0) {
            $cover = $post->cover()->first();
            $size = Settings::getUnserialize('thumbnails_size')[$size]['value'];

            if ($size) {
                $size = implode('_', $size);
                $path = '/storage/' . $cover->path;

                $filename = $cover->name;
                $filename = $path . $filename . '_' . $size . '.jpg';

                return URL::to($filename);
            } else {
                return null;
            }
        }
    }

}

// Получаем дату поста с русским языком
if (! function_exists('get_post_locale_date')) {

    function get_post_locale_date($format = 'j F Y', $is_updated_at = false) {
        global $post;

        $date = Date::parse(($is_updated_at ? $post->updated_at : $post->created_at));
        return $date->format($format);
    }

}

// Получаем кол-во категорий
if (! function_exists('get_post_cats_count')) {

    function get_post_cats_count() {
        global $post;
        static $i = 0;

        return $post->cats->count();
    }

}

// Получаем категории (ДЛЯ WHILE ЦИКЛА)
if (! function_exists('get_post_cats')) {

    function get_post_cats() {
        global $post;
        static $i = 0;

        if (isset($post->cats[$i])) {
            $current_cat = $post->cats[$i];
            $i++;
            $GLOBALS['cat'] = $current_cat;
            return $current_cat;
        } else {
            unset($i);
            return false;
        }
    }

}

// Получаем имя категории
if (! function_exists('get_cat_title')) {

    function get_cat_title() {
        global $cat;
        return $cat->name;
    }

}

// Получаем ссылку категории
if (! function_exists('get_cat_link')) {

    function get_cat_link() {
        global $cat;
        return url('/blog/' . $cat->slug);
    }

}


// Получаем кол-во тегов
if (! function_exists('get_post_tags_count')) {

    function get_post_tags_count() {
        global $post;
        static $i = 0;

        return $post->tags->count();
    }

}

// Получаем теги (ДЛЯ WHILE ЦИКЛА)
if (! function_exists('get_post_tags')) {

    function get_post_tags() {
        global $post;
        static $i = 0;

        if (isset($post->tags[$i])) {
            $current_tag = $post->tags[$i];
            $i++;
            $GLOBALS['tag'] = $current_tag;
            return $current_tag;
        } else {
            unset($i);
            return false;
        }
    }

}

// Получаем имя тега
if (! function_exists('get_tag_title')) {

    function get_tag_title() {
        global $tag;
        return $tag->name;
    }

}

// Получаем ссылку тега
if (! function_exists('get_tag_link')) {

    function get_tag_link() {
        global $tag;
        return '/blog/tag/' . $tag->slug;
    }

}

// Получаем автора поста
if (! function_exists('get_post_author')) {

    function get_post_author() {
        global $post;
        return (isset($post->author) ? $post->author->name : '');
    }

}

// Получаем ссылку вложения
if (! function_exists('get_post_attach_link')) {

    function get_post_attach_link() {
        global $post;
        if ($post->files()->count() > 0) {
            $file = $post->files()->first();
            return '/storage/' . $file->path . $file->name . '.' . $file->extension;
        }
        return null;
    }

}

// Получаем тип вложения
if (! function_exists('get_post_attach_type')) {

    function get_post_attach_type() {
        global $post;
        if ($post->files()->count() > 0) {
            foreach ($post->files()->get() as $file) {
                if ($file->extension == 'pdf') {
                    return '<i class="icon icon-pdf-file"></i>';
                } else if ($file->extension == 'doc') {
                    return '<i class="icon icon-doc"></i>';
                } else if ($file->extension == 'zip' || $file->extension == 'rar') {
                    return '<i class="icon icon-zip"></i>';
                }
            }
        }
        return null;
    }

}

// Получаем мета поста
if (! function_exists('get_post_meta')) {

    function get_post_meta($field, $default_value = null) {
        global $post;
        return (isset($post->meta_data[$field]) ? $post->meta_data[$field]->value : $default_value);
    }

}

// Получаем шаблон поста
if (! function_exists('get_post_template')) {

    function get_post_template($template = null) {
        global $post;

        return ($template ? $template : $post->template);
    }

}

// Для сетки постов (1:1:1, 2:1 и т.д.)
if (! function_exists('get_post_list_used_space')) {

    function get_post_list_used_space() {
        global $used_space;
        return (isset($used_space) ? $used_space : 0);
    }

}

// Для передачи порядка сетки постов в ajax
if (! function_exists('get_post_list_current_used_space')) {

    function get_post_list_current_used_space() {
        global $prev_used_space;
        return (isset($prev_used_space) ? $prev_used_space : 0);
    }

}

/*
 * *******************************************************
 * Realty хелперы
 * *******************************************************
 */

if (! function_exists('get_realty_link')) {
    function get_realty_link($realty) {
        return route('realty.show', ['slug' => isset($realty->slug) ? $realty->slug : '#']);
    }
}

if (! function_exists('get_realty_photos')) {
    function get_realty_photos($realty) {
        return $realty->attachments->where('pivot.type', 'photo');
    }
}

if (! function_exists('get_breadcrumbs')) {
    function get_breadcrumbs($realty) {
        return view('components.breadcrumbs', [
            'realty_type' => $realty->type,
            'realty_trade_type' => $realty->trade_type,
            'realty_room_type' => $realty->room_type,
            'realty_dop_type' => $realty->dop_type,
        ])->render();
    }
}

if (! function_exists('get_realty_nav')) {
    function get_realty_nav($realty_next) {
        return view('components.realty_nav', [
            'realty_next' => isset($realty_next) ? $realty_next : null,
        ])->render();
    }
}

/*
 * *******************************************************
 * realty хелперы
 * *******************************************************
 */



/*
 * *******************************************************
 * Остальные хелперы
 * *******************************************************
 */

// Вывод реквизитов в json для js
if (! function_exists('get_json_payment_details')) {

    function get_json_payment_details() {
        return json_encode(unserialize(Settings::get('payment_details')) ?? false);
    }

}

// Получаем дату после форматирования
if (! function_exists('get_locale_date')) {

    function get_locale_date($date, $format = 'j F Y') {
        if (isset($date) && !empty(trim($date))) {
            $date = Date::parse($date);
            return $date->format($format);
        } else {
            return null;
        }
    }

}

// Функция для while-цикла поста DERKACH
if (! function_exists('get_menu')) {

    function get_menu($alias, $options) {
        global $menu;
        $html = '';

        if ($menu->get($alias)) {
            $current_menu = $menu->get($alias);

            if ($current_menu['items']->count() > 0) {
                $ul_class = (isset($options['ul_class']) ? ' ' . $options['ul_class'] : '');
                $li_class = (isset($options['li_class']) ? ' ' . $options['li_class'] : '');

                $html .= '<ul class="menu-nav'.$ul_class.'">';
                foreach ($current_menu['items'] as $item) {
                    $html .= '<li class="' . (isset($item->class) ? ' ' . $item->class : null) . $li_class . '"><a href="' . url( '/' . $item->url) . '">' . ($item->icon ? '<i class="icon ' . $item->icon . '"></i>' : '') . $item->title . '</a></li>';
                }
                $html .= '</ul>';
            }
        }

        return $html;
    }

}

// Получение изображения поста
if (! function_exists('get_image_thumbnail_url')) {

    function get_image_thumbnail_url($attachment, $size, $absolute_path = true) {
        $image = $attachment;
        $size = config('filesystems.thumbnails_size')[$size]['value'];

        if ($size) {
            $size = implode('_', $size);
            $path = '/storage/' . $image->path;

            $filename = $image->name;
            $filename = str_replace('\\', '/', $path) . $filename . '_' . $size . '.jpg';

            return $absolute_path ? URL::to($filename) : $filename;
        } else {
            return null;
        }
    }

}

/**
 * *******************************************************
 * Страницы
 * *******************************************************
 */

// Заголовок поста
if (! function_exists('get_page_meta_title')) {

    function get_page_meta_title() {
        global $page;
        return strip_tags(get_page_meta('meta_title', $page->title ?? ''));
    }

}

// Заголовок поста
if (! function_exists('get_page_meta_description')) {

    function get_page_meta_description() {
        global $page;
        return strip_tags(get_page_meta('meta_description', Post::getExcerpt(shortcodes_clean($page->content ?? ''), 140)));
    }

}

// Заголовок поста
if (! function_exists('get_page_meta_keywords')) {

    function get_page_meta_keywords() {
        global $page;
        if (!isset($page->tags)) {
            return '';
        }

        if (!empty(strip_tags(get_page_meta('meta_keywords'))) && count($page->tags->pluck('name')->all()) > 0) {
            return strip_tags(get_page_meta('meta_keywords')) . ', ' . implode(', ', $page->tags->pluck('name')->toArray());
        } else {
            return strip_tags(get_page_meta('meta_keywords')) . implode(', ', $page->tags->pluck('name')->all());
        }
    }

}

// Получаем мета поста
if (! function_exists('get_page_meta')) {

    function get_page_meta($field, $default_value = null) {
        global $page;
        return (isset($page->meta_data[$field]) ? $page->meta_data[$field]->value : $default_value);
    }

}

/**
 * *******************************************************
 * Хелперы шорткодов
 * *******************************************************
 */

// Обрабатываем шорткод и возвращаем результат
if (! function_exists('shortcodes_parse')) {

    function shortcodes_parse($html) {
        return Shortcodes::parseShortcodes($html);
    }

}

// Удаляем все шорткоды из страки
if (! function_exists('shortcodes_clean')) {

    function shortcodes_clean($html) {
        return Shortcodes::cleanShortcodes($html);
    }

}

/**
 * *******************************************************
 * Системные хелперы (для контроллеров и моделей)
 * *******************************************************
 */

// Парсинг аргументов шорткодов для вывода на view
if (! function_exists('shortcode_args_to_string')) {

    function shortcode_args_to_string($args) {
        if ($args) {
            unset($args['html'], $args['shortcode']);
            foreach ($args as $k => $arg) {
                if (strpos($k, 'data') !== false) {
                    $args[$k] = "{$k}=\"{$arg}\"";
                } else {
                    unset($args[$k]);
                }
            }
            $args = implode(' ', $args);
        }
        return $args;
    }

}

// Конверт в булеан
if (! function_exists('toBoolean')) {

    function toBoolean($str) {
        if ($str) {
            return filter_var($str, FILTER_VALIDATE_BOOLEAN);
        } else {
            return false;
        }
    }

}

if (! function_exists('clear_string')) {

    function clear_string($string) {
        if (!isset($string) || is_bool($string)) {
            return null;
        }

        $string = strip_tags($string);
        $string = addslashes($string);
        $string = trim($string);
        return !empty($string) ? $string : null;
    }

}

if (! function_exists('clear_numeric')) {

    function clear_numeric($numeric) {
        if (!isset($numeric) || is_bool($numeric)) {
            return null;
        }

        $numeric = preg_match('/[0-9,.]+/', $numeric, $matches);
        $numeric = $matches[0];
        return !empty($numeric) ? $numeric : null;
    }

}

