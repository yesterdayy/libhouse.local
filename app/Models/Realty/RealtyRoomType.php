<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealtyRoomType extends Model
{

    protected $table = 'realty_room_type';

    public static function realty_room_type($args) {
        $room_types = RealtyRoomType::all();
        if (isset($args['with-count'])) {
            try {
                $entry_counts = DB::select("SELECT `room_type`.id, COUNT(*) `count`
                FROM `realty_room_type` `room_type`
                LEFT JOIN `realty_entry` `entry` ON `entry`.room_type_id = `room_type`.id
                WHERE `entry`.`status` = 'published'
                GROUP BY `room_type`.id");
                $entry_counts = array_column($entry_counts, 'count', 'id');

                foreach ($room_types as $room_type) {
                    $room_type->cnt = $entry_counts[$room_type->id] ?? 0;
                }
            } catch (\Exception $err) {

            }
        }
        return $room_types;
    }

}
