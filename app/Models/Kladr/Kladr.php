<?php

namespace App\Models\Kladr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        $result = DB::select("SELECT CODE `CITY_CODE`, SOCR `CITY_SOCR`, NAME `CITY_NAME` 
        FROM kladr.kladr 
        WHERE $where 
        AND `NAME` LIKE '$city_name%' 
        AND RIGHT(`CODE`, 2) = '00' 
        ORDER BY `SOCR` IS NULL ASC, FIELD(`SOCR`, 'г', 'пгт', 'c', 'аал', 'автодорога', 'АО', 'Аобл', 'арбан', 'аул', 'волость', 'высел', 'г-к', 'г.о.', 'гп', 'д', 'днп', 'дп', 'ж/д пл-ка', 'ж/д_будка', 'ж/д_казарм', 'ж/д_оп', 'ж/д_платф', 'ж/д_пост', 'ж/д_рзд', 'ж/д_ст', 'жилзона', 'жилрайон', 'заимка', 'казарма', 'кв-л', 'кордон', 'кп', 'край', 'лпх', 'м', 'массив', 'мкр', 'нп', 'обл', 'округ', 'остров', 'п', 'п. ж/д ст.', 'п/о', 'п/р', 'п/ст', 'погост', 'починок', 'промзона', 'р-н', 'Респ', 'рзд', 'рп', 'с', 'с/а', 'с/мо', 'с/о', 'с/п', 'с/с', 'сл', 'снт', 'ст', 'ст-ца', 'тер', 'у', 'ул', 'х', 'Чувашия', '') ASC
        LIMIT " . $limit);

        return $result;
    }

    public static function city_by_kladrs($city_kladr) {
        if (!empty($city_kladr)) {
            $city_kladr = is_array($city_kladr) ? $city_kladr : array($city_kladr);
            $city_kladr = "'" . implode("', '", $city_kladr) . "'";

            $result = DB::select("SELECT `CODE`, `NAME` 
            FROM kladr.kladr 
            WHERE `CODE` IN ($city_kladr)
            AND RIGHT(`CODE`, 2) = '00' 
            ORDER BY `SOCR` IS NULL ASC, FIELD(`SOCR`, 'г', 'пгт', 'c', 'аал', 'автодорога', 'АО', 'Аобл', 'арбан', 'аул', 'волость', 'высел', 'г-к', 'г.о.', 'гп', 'д', 'днп', 'дп', 'ж/д пл-ка', 'ж/д_будка', 'ж/д_казарм', 'ж/д_оп', 'ж/д_платф', 'ж/д_пост', 'ж/д_рзд', 'ж/д_ст', 'жилзона', 'жилрайон', 'заимка', 'казарма', 'кв-л', 'кордон', 'кп', 'край', 'лпх', 'м', 'массив', 'мкр', 'нп', 'обл', 'округ', 'остров', 'п', 'п. ж/д ст.', 'п/о', 'п/р', 'п/ст', 'погост', 'починок', 'промзона', 'р-н', 'Респ', 'рзд', 'рп', 'с', 'с/а', 'с/мо', 'с/о', 'с/п', 'с/с', 'сл', 'снт', 'ст', 'ст-ца', 'тер', 'у', 'ул', 'х', 'Чувашия', '') ASC
            LIMIT 1");

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

        $result = DB::select("SELECT * FROM (
        SELECT street.CODE `STREET_CODE`, street.SOCR `STREET_SOCR`, `street`.NAME `STREET_NAME`,
        city.CODE `CITY_CODE`, city.SOCR `CITY_SOCR`, `city`.NAME `CITY_NAME`
        FROM kladr.street `street`
        LEFT JOIN kladr.kladr `city` ON city.CODE = LEFT(street.CODE, 13)
        WHERE 1 $city_code AND street.`NAME` LIKE '$street_name%' 
        $region_code
        AND RIGHT(street.`CODE`, 2) = '00' 
        AND RIGHT(city.`CODE`, 2) = '00'
        AND city.SOCR NOT IN ('Респ')
        ) `tbl`
        ORDER BY `CITY_SOCR` IS NULL ASC, FIELD(`CITY_SOCR`, 'г', 'пгт', 'c', 'аал', 'автодорога', 'АО', 'Аобл', 'арбан', 'аул', 'волость', 'высел', 'г-к', 'г.о.', 'гп', 'д', 'днп', 'дп', 'ж/д пл-ка', 'ж/д_будка', 'ж/д_казарм', 'ж/д_оп', 'ж/д_платф', 'ж/д_пост', 'ж/д_рзд', 'ж/д_ст', 'жилзона', 'жилрайон', 'заимка', 'казарма', 'кв-л', 'кордон', 'кп', 'край', 'лпх', 'м', 'массив', 'мкр', 'нп', 'обл', 'округ', 'остров', 'п', 'п. ж/д ст.', 'п/о', 'п/р', 'п/ст', 'погост', 'починок', 'промзона', 'р-н', 'Респ', 'рзд', 'рп', 'с', 'с/а', 'с/мо', 'с/о', 'с/п', 'с/с', 'сл', 'снт', 'ст', 'ст-ца', 'тер', 'у', 'ул', 'х', 'Чувашия', '') ASC
        , `STREET_SOCR` IS NULL ASC, FIELD(`STREET_SOCR`, 'ул', 'ш', 'аллея', 'а/я', 'аал', 'б-р', 'берег', 'вал', 'взв.', 'въезд', 'городок', 'гск', 'д', 'днп', 'дор', 'дп', 'ж/д_будка', 'ж/д_казарм', 'ж/д_оп', 'ж/д_платф', 'ж/д_пост', 'ж/д_рзд', 'ж/д_ст', 'ж/р', 'жилрайон', 'жт', 'заезд', 'зона', 'казарма', 'кв-л', 'км', 'кольцо', 'коса', 'линия', 'м', 'мгстр.', 'местность', 'месторожд.', 'мкр', 'мост', 'н/п', 'наб', 'нп', 'остров', 'п', 'п/о', 'п/р', 'п/ст', 'парк', 'пгт', 'пер', 'переезд', 'пл', 'пл-ка', 'платф', 'порт', 'пр-кт', 'проезд', 'промзона', 'просек', 'просека', 'проселок', 'проулок', 'р-н', 'рзд', 'ряд', 'ряды', 'с', 'с/т', 'сад', 'сзд.', 'сквер', 'сл', 'снт', 'спуск', 'ст', 'стр', 'тер', 'тер. ГСК', 'тер. ДНО', 'тер. ДНП', 'тер. ДНТ', 'тер. ДПК', 'тер. ОНО', 'тер. ОНП', 'тер. ОНТ', 'тер. ОПК', 'тер. ПК', 'тер. СНО', 'тер. СНП', 'тер. СНТ', 'тер. СПК', 'тер. ТСН', 'тер.СОСН', 'тер.ф.х.', 'тракт', 'туп', 'ус.', 'уч-к', 'ф/х', 'ферма', 'х') ASC
        LIMIT " . $limit);

        return $result;
    }

    public static function street_alternative($street_name = null, $city_code, $region_code = null, $limit = null, $with_city_title = false) {
        $result = ['results' => []];

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

        $data = DB::select("SELECT * FROM (
        SELECT street.`CODE`, street.`SOCR`, city.`SOCR` `CITY_SOCR`, CONCAT_WS(', ', city.`NAME`, CONCAT(street.`SOCR`, '. ', street.`NAME`)) `NAME`
        FROM kladr.street `street`
        LEFT JOIN kladr.kladr `city` ON city.CODE = LEFT(street.CODE, 13)
        WHERE 1 $city_code AND street.`NAME` LIKE '$street_name%' 
        $region_code
        AND RIGHT(street.`CODE`, 2) = '00' 
        AND RIGHT(city.`CODE`, 2) = '00'
        AND city.SOCR NOT IN ('Респ')
        ) `tbl`
        ORDER BY `CITY_SOCR` IS NULL ASC, FIELD(`CITY_SOCR`, 'г', 'пгт', 'c', 'аал', 'автодорога', 'АО', 'Аобл', 'арбан', 'аул', 'волость', 'высел', 'г-к', 'г.о.', 'гп', 'д', 'днп', 'дп', 'ж/д пл-ка', 'ж/д_будка', 'ж/д_казарм', 'ж/д_оп', 'ж/д_платф', 'ж/д_пост', 'ж/д_рзд', 'ж/д_ст', 'жилзона', 'жилрайон', 'заимка', 'казарма', 'кв-л', 'кордон', 'кп', 'край', 'лпх', 'м', 'массив', 'мкр', 'нп', 'обл', 'округ', 'остров', 'п', 'п. ж/д ст.', 'п/о', 'п/р', 'п/ст', 'погост', 'починок', 'промзона', 'р-н', 'Респ', 'рзд', 'рп', 'с', 'с/а', 'с/мо', 'с/о', 'с/п', 'с/с', 'сл', 'снт', 'ст', 'ст-ца', 'тер', 'у', 'ул', 'х', 'Чувашия', '') ASC
        , `SOCR` IS NULL ASC, FIELD(`SOCR`, 'ул', 'ш', 'аллея', 'а/я', 'аал', 'б-р', 'берег', 'вал', 'взв.', 'въезд', 'городок', 'гск', 'д', 'днп', 'дор', 'дп', 'ж/д_будка', 'ж/д_казарм', 'ж/д_оп', 'ж/д_платф', 'ж/д_пост', 'ж/д_рзд', 'ж/д_ст', 'ж/р', 'жилрайон', 'жт', 'заезд', 'зона', 'казарма', 'кв-л', 'км', 'кольцо', 'коса', 'линия', 'м', 'мгстр.', 'местность', 'месторожд.', 'мкр', 'мост', 'н/п', 'наб', 'нп', 'остров', 'п', 'п/о', 'п/р', 'п/ст', 'парк', 'пгт', 'пер', 'переезд', 'пл', 'пл-ка', 'платф', 'порт', 'пр-кт', 'проезд', 'промзона', 'просек', 'просека', 'проселок', 'проулок', 'р-н', 'рзд', 'ряд', 'ряды', 'с', 'с/т', 'сад', 'сзд.', 'сквер', 'сл', 'снт', 'спуск', 'ст', 'стр', 'тер', 'тер. ГСК', 'тер. ДНО', 'тер. ДНП', 'тер. ДНТ', 'тер. ДПК', 'тер. ОНО', 'тер. ОНП', 'тер. ОНТ', 'тер. ОПК', 'тер. ПК', 'тер. СНО', 'тер. СНП', 'тер. СНТ', 'тер. СПК', 'тер. ТСН', 'тер.СОСН', 'тер.ф.х.', 'тракт', 'туп', 'ус.', 'уч-к', 'ф/х', 'ферма', 'х') ASC
        LIMIT " . $limit);
        if (!empty($data)) {
            foreach ($data as $item) {
                $result['results'][] = [
                    'id' => $item->CODE,
                    'text' => $item->NAME
                ];
            }
        }

        return $result;
    }

    public static function get_city_by_kladr($kladr) {
        return DB::select("SELECT `NAME` FROM kladr.kladr WHERE `CODE` = $kladr LIMIT 1")[0]->NAME;
    }

    public static function get_street_by_kladr($kladr) {
        return DB::select("SELECT `NAME` FROM kladr.street WHERE `CODE` = $kladr LIMIT 1")[0]->NAME;
    }

    public static function get_popular_cities($per_row = 5) {
        $cities = DB::select("SELECT `NAME`
        FROM `kladr`.kladr 
        WHERE (`CODE` LIKE '92%' OR `CODE` LIKE '91%') and socr = 'г' AND RIGHT(`CODE`, 2) = '00'
        ORDER BY `NAME`");

        $result = array_chunk($cities, $per_row);

        return $result;
    }

}
