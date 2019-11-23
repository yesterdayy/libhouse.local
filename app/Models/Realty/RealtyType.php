<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealtyType extends Model
{

    protected $table = 'realty_type';
    public $fillable = ['name'];
    public $timestamps = false;

    const ARENDA_ID = 1;

    public static function realty_type($args) {
        if (isset($args['commercy'])) {
            $types = RealtyType::where('commercy', 1)->orderBy('commercy', 'asc')->get();
            if (isset($args['with-count'])) {
                try {
                    $entry_counts = DB::select("SELECT `type`.id, COUNT(*) `count`
                    FROM `realty_type` `type`
                    LEFT JOIN `realty_entry` `entry` ON `entry`.type_id = `type`.id
                    WHERE `entry`.`status` = 'published'
                    AND `type`.commercy = 1
                    GROUP BY `type`.id");
                    $entry_counts = array_column($entry_counts, 'count', 'id');

                    foreach ($types as $type) {
                        $type->cnt = $entry_counts[$type->id] ?? 0;
                    }
                } catch (\Exception $err) {
                    dd($err);
                }
            }
        } else {
            $types = RealtyType::orderBy('commercy', 'asc')->get();
            if (isset($args['with-count'])) {
                try {
                    $entry_counts = DB::select("SELECT `type`.id, COUNT(*) `count`
                    FROM `realty_type` `type`
                    LEFT JOIN `realty_entry` `entry` ON `entry`.type_id = `type`.id
                    WHERE `entry`.`status` = 'published'
                    GROUP BY `type`.id");
                    $entry_counts = array_column($entry_counts, 'count', 'id');

                    foreach ($types as $type) {
                        $type->cnt = $entry_counts[$type->id] ?? 0;
                    }
                } catch (\Exception $err) {

                }
            }
        }
        return $types;
    }

}
