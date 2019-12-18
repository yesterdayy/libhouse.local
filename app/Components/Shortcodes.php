<?php

namespace App\Components;

use Illuminate\Support\Facades\App;

class Shortcodes extends App
{
    private static $shortcodes = [];

    const SUFFIX_SHORTCODE_FUNCTION = '_shortcode';

    public static function getShortcode($tag, $args) {
        if (isset(self::$shortcodes[$tag])) {
            $class = '\App\\Models\\'.ucfirst(self::$shortcodes[$tag]['path'][0]);
            $method = self::$shortcodes[$tag]['path'][1];

            if (class_exists($class) && method_exists($class, $method)) {
                view()->share('shortcode_string_args', shortcode_args_to_string($args));
                view()->share('shortcode_args', $args);
                view()->share('widget_class', $args['shortcode']);
                view()->share('widget_title', $args['widget_title'] ?? null);
                view()->share('ajax', request()->ajax());
                return $class::$method($args);
            }
        }

        return null;
    }

    public static function addShortcode($tag, $path) {
        $path[1] = $path[1] . self::SUFFIX_SHORTCODE_FUNCTION;

        self::$shortcodes[$tag] = [
            'tag' => $tag,
            'path' => $path
        ];
    }

    private static function getArgs($items) {
        $params = [];
        foreach ($items as $item) {
            $itemFix = str_replace([' = ', ' =', '= ', '[', ']'], '', $item);

            $argsTmp = explode(' ', $itemFix, 2);
            $code = $argsTmp[0];

            if (isset($argsTmp[1])) {
                preg_match_all('/([a-zA-Zа-яА-ЯёЁ_-]+)=["\']([a-zA-Zа-яА-ЯёЁ\d ,.\\\"\'_\/-]+)["\']/u', $argsTmp[1], $args);
            }

            $numCode = 0;
            if (isset($params[$code])) {
                end($params[$code]);
                $numCode = key($params[$code]) + 1;
            }

            $params[$code][$numCode]['html'] = $item;
            $params[$code][$numCode]['shortcode'] = $code;
            if (isset($argsTmp[1])) {
                for ($i = 0; $i < count($args[2]); $i++) {
                    $params[$code][$numCode][$args[1][$i]] = $args[2][$i];
                }
            }
        }
        return $params;
    }

    public static function parseShortcodes($content) {
        static $exit = 0;

        if ($exit > 2) {
            return $content;
        }

        if (strpos($content, "[") !== false) {
            preg_match_all('/\[[\w\dа-яА-ЯёЁ =\"\',.\/\\\-]+\]/u', $content, $matches);

            if (!empty($matches[0])) {
                $shortcodes = self::getArgs($matches[0]);

                $count_not_shortcodes = 0;
                foreach ($shortcodes as $key => $shortcode) {
                    foreach ($shortcode as $args) {
                        if (count($args) > 0) {
                            $result = Shortcodes::getShortcode($key, $args);
                            if (is_null($result)) {
                                $count_not_shortcodes++;
                            } else {
                                $content = str_replace($args['html'], $result, $content);
                            }
                        } else {
                            $content = str_replace($args['html'], '', $content);
                        }
                    }
                }
            }
        }

        preg_match_all('/\[[\w\dа-яА-ЯёЁ =\"\',.\\\-]+\]/u', $content, $matches);

        $exit++;
        return (!empty($matches[0] && count($matches[0]) != $count_not_shortcodes) ? self::parseShortcodes($content) : $content);
    }

    public static function cleanShortcodes($content) {
        if (strpos($content, "[") !== false) {
            return preg_replace('/\[[\w\dа-яА-ЯёЁ =\"\',.\\\-]+\]/u', '', $content);
        }
        return $content;
    }
}
