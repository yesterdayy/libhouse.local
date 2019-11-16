<?php

namespace App\Models\Realty;

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

        if ($request['header_address_city']) {
            $where[] = " `re`.`city` = {$request['header_address_city']} ";
        }

        if ($request['header_address_street']) {
            $where[] = " `re`.`street` = {$request['header_address_street']} ";
        }

        if ($request['type']) {
            $where[] = " `re`.`type_id` IN (".implode(', ', $request['type']).") ";
        }

        if ($request['trade_type']) {
            $where[] = " `re`.`trade_type_id` = {$request['trade_type']} ";
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

        $result = [];

        if (!empty($where)) {
            $where = ' AND ' . implode(' AND ', $where);
        } else {
            $where = '';
        }

        $count = DB::select("SELECT COUNT(*) `count`
        FROM `realty_entry` `re`
        WHERE `re`.`status` = 'published' $where");

        $result = DB::select("SELECT `re`.*
        FROM `realty_entry` `re`
        LEFT JOIN `users` ON `users`.id = `re`.author_id
        WHERE `re`.`status` = 'published' $where
        ORDER BY `re`.`id` DESC
        LIMIT $start, $length");


        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($result, $count[0]->count, $length, isset($request['page']) ?? 1, ['path' => Request::fullUrl(), 'query']);

        return [Realty::hydrate($result), $paginator];
    }

}
