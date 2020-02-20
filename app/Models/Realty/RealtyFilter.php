<?php

namespace App\Models\Realty;

use App\Models\Kladr\Kladr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

class RealtyFilter extends Model
{

    private const REALTY_TYPES = ['owner' => 1, 'realtor' => 2, 'builder' => 3];

    public static function getRealty($request) {
        $length = $request['length'] ?? 9;
        $start = isset($request['page']) ? ($request['page'] - 1) * $length : 0;

        $where = [];

        if ($request['term']) {
            $where[] = " `re`.`title` LIKE '%{$request['term']}%' ";
        }

        if ($request['city']) {
            $city = Kladr::get_city_by_name($request['city']);
            if (!empty($city)) {
                $where[] = " `re`.`city` = {$city->CODE} ";

                if ($request['street']) {
                    $street = Kladr::get_street_by_name($city->CODE, $request['street']);
                    if (!empty($street)) {
                        $where[] = " `re`.`street` = {$street->CODE} ";
                    }
                }
            }
        }

        if ($request['type']) {
            $where[] = " `re`.`type_id` IN (".implode(', ', $request['type']).") ";
        }

        if ($request['trade_type']) {
            $where[] = " `re`.`trade_type_id` = {$request['trade_type']} ";
        }

        if ($request['rent_duration']) {
            $where[] = " `re`.`rent_duration_id` = {$request['rent_duration']} ";
        }

        if ($request['room_type']) {
            $where[] = " `re`.`room_type_id` IN (".implode(', ', $request['room_type']).") ";
        }

        if ($request['dop_type']) {
            $where[] = " `re`.`dop_type_id` = {$request['dop_type']} ";
        }

        if ($request['price_start']) {
            $where[] = " `re`.`price` >= {$request['price_start']} ";
        }

        if ($request['price_end']) {
            $where[] = " `re`.`price` <= {$request['price_end']} ";
        }

        $sort = '';
        switch ($request['sort']) {
            case 'price_asc':
                $order = 'ORDER BY `re`.`price` ASC';
                break;

            case 'price_desc':
                $order = 'ORDER BY `re`.`price` DESC';
                break;

            case 'square_desc':
                $order = 'ORDER BY `rei`.value DESC';
                break;

            default:
                $order = 'ORDER BY `re`.`id` DESC';
                break;
        }

        $result = [];

        if (!empty($where)) {
            $where = ' AND ' . implode(' AND ', $where);
        } else {
            $where = '';
        }

        $count = DB::select("SELECT COUNT(*) `count`
        FROM `realty_entry` `re`
        LEFT JOIN `realty_entry_info` `rei` ON `rei`.realty_id = `re`.id AND `rei`.`field` = 'square_common'
        WHERE `re`.`status` = 'published' $where");

        $result = DB::select("SELECT `re`.*
        FROM `realty_entry` `re`
        LEFT JOIN `realty_entry_info` `rei` ON `rei`.realty_id = `re`.id AND `rei`.`field` = 'square_common'
        LEFT JOIN `users` ON `users`.id = `re`.author_id
        WHERE `re`.`status` = 'published' $where
        $order
        LIMIT $start, $length");

        $result = Realty::with('info', 'attachments')->hydrate($result);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($result, $count[0]->count, $length, isset($request['page']) ?? 1, ['path' => Request::fullUrl(), 'query']);

        return $result;
    }

}
