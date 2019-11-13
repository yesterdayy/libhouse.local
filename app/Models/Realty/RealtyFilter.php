<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealtyFilter extends Model
{

    private const REALTY_TYPES = ['owner' => 1, 'realtor' => 2, 'builder' => 3];

    public static function getRealty($request) {
        $start = $request['start'] ?? 0;
        $length = $request['length'] ?? 10;

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

        $result = DB::select("SELECT `re`.*
        FROM `realty_entry` `re`
        LEFT JOIN `users` ON `users`.id = `re`.author_id
        WHERE `re`.`status` = 'published' $where
        ORDER BY `re`.`id` DESC
        LIMIT $start, $length");

        return Realty::hydrate($result);
    }

}
