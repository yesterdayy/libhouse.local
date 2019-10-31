<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'blog_menu';
    public $timestamps = false;

    private static $menus = null;
    private static $instance = null;

    public static function instance()
    {
        if (!self::$instance) {
            $menusAll = Menu::all();
            $menus = [];
            foreach ($menusAll as $menu) {
                $menus[$menu->alias] = $menu->toArray();
                $menus[$menu->alias]['items'] = $menu->items;
            }
            self::$menus = $menus;
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function get($type) {
        return (self::$menus[$type] ? self::$menus[$type] : null);
    }

    public static function getItems($type) {
        return (self::$menus[$type] ? self::$menus[$type]['items'] : null);
    }

    public function items()
    {
        return $this->hasMany('App\Models\Menu\MenuList', 'menu_id', 'id')->orderBy('order', 'asc');
    }

}
