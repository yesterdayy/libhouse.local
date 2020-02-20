<?php

namespace App\Models\Kladr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Kladr extends Model
{

    protected static $limit = 10;

    public static function city($city_name, $region_code, $limit = null, $with_socr = true) {
        $result = ['results' => []];
        $where = '1';

        if (!$limit) {
            $limit = self::$limit;
        }

        if ($region_code == '91' || $region_code == '92') {
            $where = " (`CODE` LIKE '91%' OR `CODE` LIKE '92%')";
        } else {
            $where = "`CODE` LIKE '$region_code%'";
        }

        $result = DB::connection('kladr')->select("SELECT CODE `CITY_CODE`, SOCR `CITY_SOCR`, NAME `CITY_NAME` 
        FROM kladr 
        LEFT JOIN  socrbase `socr` ON socr.SCNAME = kladr.SOCR
        WHERE $where 
        AND `NAME` LIKE '$city_name%' 
        AND RIGHT(`CODE`, 2) = '00' 
        ORDER BY socr.`LEVEL` ASC
        LIMIT " . $limit);

        return $result;
    }

    public static function city_by_kladrs($city_kladr) {
        if (!empty($city_kladr)) {
            $city_kladr = is_array($city_kladr) ? $city_kladr : array($city_kladr);
            $city_kladr = "'" . implode("', '", $city_kladr) . "'";

            $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME` 
            FROM kladr 
            LEFT JOIN  socrbase `socr` ON socr.SCNAME = kladr.SOCR
            WHERE `CODE` IN ($city_kladr)
            AND RIGHT(`CODE`, 2) = '00' 
            ORDER BY socr.`LEVEL` ASC");

            $result = array_column($result, 'NAME', 'CODE');
        } else {
            $result = [];
        }

        return $result;
    }

    public static function street($street_name, $city_code = null, $region_code = null, $limit = null, $with_city_title = false) {
        if (!$limit) {
            $limit = self::$limit;
        }

        if (!empty($city_code)) {
            $city_code = is_array($city_code) ? $city_code : array($city_code);
            $city_codes = [];
            foreach ($city_code as $citycode) {
                $city_codes[] = " street.`CODE` LIKE '$citycode%' ";
            }
            if (!empty($city_codes)) {
                $city_code = ' AND (' . implode(' OR ', $city_codes) . ') ';
            } else {
                $city_code = '';
            }
        } else {
            $city_code = '';
        }

        if (!empty($region_code)) {
            $region_code = is_array($region_code) ? $region_code : array($region_code);
            $region_codes = [];
            foreach ($region_code as $regcode) {
                $region_codes[] = " street.`CODE` LIKE '$regcode%' ";
            }

            if (!empty($region_codes)) {
                $region_code = " AND (" . implode(' OR ', $region_codes) . ") ";
            } else {
                $region_code = '';
            }
        } else {
            $region_code = '';
        }

        $result = DB::connection('kladr')->select("SELECT * FROM (
        SELECT street.CODE `STREET_CODE`, street.SOCR `STREET_SOCR`, `street`.NAME `STREET_NAME`,
        city.CODE `CITY_CODE`, city.SOCR `CITY_SOCR`, `city`.NAME `CITY_NAME`,
        socr.`LEVEL`
        FROM street `street`
        LEFT JOIN kladr `city` ON city.CODE = CONCAT(LEFT(street.CODE, 11), '00')
        LEFT JOIN  socrbase `socr` ON socr.SCNAME = street.SOCR
        WHERE 1 $city_code AND street.`NAME` LIKE '$street_name%' 
        $region_code
        AND RIGHT(street.`CODE`, 2) = '00' 
        AND RIGHT(city.`CODE`, 2) = '00'
        AND city.SOCR NOT IN ('Респ')
        ) `tbl`
        ORDER BY `LEVEL` ASC
        LIMIT " . $limit);

        return $result;
    }

    public static function get_city_by_kladr(string $kladr) {
        $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME`, `SOCR`, `SLUG` FROM kladr WHERE `CODE` = '$kladr' LIMIT 1");
        if ($result) {
            $result = $result[0];
        } else {
            $result = [];
        }
        return $result;
    }

    public static function get_street_by_kladr(string $kladr) {
        $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME`, `SOCR`, `SLUG` FROM street WHERE `CODE` = '$kladr' LIMIT 1");
        if ($result) {
            $result = $result[0];
        } else {
            $result = [];
        }
        return $result;
    }

    public static function get_city_by_name(string $name) {
        $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME`, `SOCR`, `SLUG` FROM kladr WHERE `NAME` = '$name' LIMIT 1");
        if ($result) {
            $result = $result[0];
        } else {
            $result = [];
        }
        return $result;
    }

    public static function get_street_by_name(string $city_code, string $name) {
        $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME`, `SOCR`, `SLUG` FROM street WHERE `NAME` = '$name' AND `CODE` LIKE '$city_code%' LIMIT 1");
        if ($result) {
            $result = $result[0];
        } else {
            $result = [];
        }
        return $result;
    }

    public static function get_city_by_slug(string $slug) {
        $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME`, `SOCR`, `SLUG` FROM kladr WHERE `SLUG` = '$slug' LIMIT 1");
        if ($result) {
            $result = $result[0];
        } else {
            $result = [];
        }
        return $result;
    }

    public static function get_street_by_slug(string $city_code, string $slug) {
        $result = DB::connection('kladr')->select("SELECT `CODE`, `NAME`, `SOCR`, `SLUG` FROM street WHERE `SLUG` = '$slug' AND `CODE` LIKE '$city_code%' LIMIT 1");
        if ($result) {
            $result = $result[0];
        } else {
            $result = [];
        }
        return $result;
    }

    public static function get_popular_cities($per_row = 5) {
        $cities = DB::connection('kladr')->select("SELECT `NAME`
        FROM kladr 
        WHERE (`CODE` LIKE '92%' OR `CODE` LIKE '91%') and socr = 'г' AND RIGHT(`CODE`, 2) = '00'
        ORDER BY `NAME`");

        $result = array_chunk($cities, $per_row);

        return $result;
    }

    public static function parse_slugs() {
//        $data = DB::connection('kladr')->select("SELECT k.`NAME`, s.SOCRNAME, k.`CODE`
//        FROM kladr k
//        LEFT JOIN socrbase s ON s.SCNAME = k.SOCR
//        WHERE 1");
//        foreach ($data as $item) {
//            $slug = Str::slug((!in_array($item->SOCRNAME, ['Город', 'Село', 'Поселок', 'Поселение']) ? ($item->SOCRNAME == 'Поселок городского типа' ? 'пгт' : $item->SOCRNAME) . '-' : '') . $item->NAME);
//            DB::connection('kladr')->select("UPDATE `kladr` SET `slug` = '$slug' WHERE `CODE` = '{$item->CODE}' LIMIT 1");
//        }
//        unset($data, $item);

        $data = DB::connection('kladr')->select("SELECT k.`NAME`, s.SOCRNAME, k.`CODE` 
        FROM street k
        LEFT JOIN socrbase s ON s.SCNAME = k.SOCR
        WHERE 1");
        foreach ($data as $item) {
            $slug = Str::slug((!in_array($item->SOCRNAME, ['Улица', 'Переулок']) ? ($item->SOCRNAME == 'Километр' ? 'км' : $item->SOCRNAME) . '-' : '') . $item->NAME);
            DB::connection('kladr')->select("UPDATE `street` SET `slug` = '$slug' WHERE `CODE` = '{$item->CODE}' LIMIT 1");
        }
        unset($data, $item);

        return 'yeah ;)';
    }

}
