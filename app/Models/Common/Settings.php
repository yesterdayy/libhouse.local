<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $table = "settings";

    protected $fillable = ['field', 'value'];

    public $timestamps = false;

    private static $settings = null;
    private static $instance = null;

    public static function instance()
    {
        if (!self::$settings) {
            $settingsAll = Settings::all()->toArray();
            $settings = [];
            foreach ($settingsAll as $setting) {
                $settings[$setting['field']] = $setting['value'];
            }
            self::$settings = $settings;
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function get($field, $default_value = null) {
        return (isset(self::$settings[$field]) ? self::$settings[$field] : $default_value);
    }

    public static function getUnserialize($field) {
        return (isset(self::$settings[$field]) ? unserialize(self::$settings[$field]) : null);
    }

    public static function set($field, $value) {
        $param = Settings::where('field', $field)->first();
        if (!$param) {
            Settings::create(['field' => $field, 'value' => $value]);
        } else {
            if ($param->value != $value) {
                $param->value = $value;
                $param->save();
            }
        }
    }

}
