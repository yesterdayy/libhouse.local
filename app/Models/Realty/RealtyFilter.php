<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealtyFilter extends Model
{

    private const REALTY_TYPES = ['owner' => 1, 'realtor' => 2, 'builder' => 3];

    public static function getRealty($request) {
        $request = $request->all();

        $start = $request['start'] ?? 0;
        $length = $request['length'] ?? 10;

        $where = [];
        $join = [];
        $join_index = 1;

        if (isset($request['type'])) {
            $where[] = " `re`.`type` = {$request['type']} ";
        }

        if (isset($request['rent_duration'])) {
            $where[] = " `re`.`rent_duration` = {$request['rent_duration']} ";
        }

        if (isset($request['price_start'])) {
            $where[] = " `re`.`price` >= {$request['price_start']} ";
        }

        if (isset($request['price_end'])) {
            $where[] = " `re`.`price` <= {$request['price_end']} ";
        }

        if (isset($request['city'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'city' AND `rei_{$join_index}`.value = '{$request['city']}' ";
            $join_index++;
        }

        if (isset($request['rooms'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'rooms' AND `rei_{$join_index}`.value = '{$request['rooms']}' ";
            $join_index++;
        }

        if (isset($request['square_common_start']) || isset($request['square_common_end'])) {
            $period = [];
            if (isset($request['square_common_start'])) {
                $period[] = " `rei_{$join_index}`.value >= {$request['square_common_start']} ";
            }
            if (isset($request['square_common_end'])) {
                $period[] = " `rei_{$join_index}`.value <= {$request['square_common_end']} ";
            }
            $period = implode(' AND ', $period);
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'square_common' AND $period ";
            $join_index++;
        }

        if (isset($request['house_type'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'house_type' AND `rei_{$join_index}`.value = '{$request['house_type']}' ";
            $join_index++;
        }

        if (isset($request['floor'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'floor' AND `rei_{$join_index}`.value = '{$request['floor']}' ";
            $join_index++;
        }

        if (isset($request['floors'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'floors' AND `rei_{$join_index}`.value = '{$request['floors']}' ";
            $join_index++;
        }

        if (isset($request['construction_year'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'construction_year' AND `rei_{$join_index}`.value = '{$request['construction_year']}' ";
            $join_index++;
        }

        if (isset($request['with_communal'])) {
            $join[] = " INNER JOIN `realty_entry_info` `rei_{$join_index}` ON `rei_{$join_index}`.realty_id = `re`.id AND `rei_{$join_index}`.`field` = 'with_communal' AND `rei_{$join_index}`.value = '1' ";
            $join_index++;
        }

        if (isset($request['owner'])) {
            $where[] = " `uat`.type_id = ".self::REALTY_TYPES['owner']." ";
        }

        if (isset($request['realtor'])) {
            $where[] = " `uat`.type_id = ".self::REALTY_TYPES['realtor']." ";
        }

        if (isset($request['builder'])) {
            $where[] = " `uat`.type_id = ".self::REALTY_TYPES['builder']." ";
        }

        $result = [];

        if (!empty($where) || !empty($join)) {
            if (!empty($where)) {
                $where = ' AND ' . implode(' AND ', $where);
            } else {
                $where = '';
            }

            if (!empty($join)) {
                $join = implode(' ', $join);
            } else {
                $join = '';
            }

            $result = DB::select("SELECT `re`.*
            FROM `realty_entry` `re`
            LEFT JOIN `users_realty_type` `uat` ON `uat`.user_id = `re`.author_id
            $join
            WHERE 1 $where
            LIMIT $start, $length");
        }

        return $result;
    }

}
