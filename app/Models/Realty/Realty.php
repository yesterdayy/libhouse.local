<?php

namespace App\Models\Realty;

use App\Models\Kladr\Kladr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Realty extends Model
{

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->author_id = Auth::user()->getAuthIdentifier();
        });
    }

    protected $table = 'realty_entry';
    protected $fillable = [
        'title',
        'type_id',
        'dop_type_id',
        'room_type_id',
        'trade_type_id',
        'rent_duration_id',
        'city',
        'street',
        'content',
        'price',
        'slug',
        'author_id',
        'status',
        'is_moderated',
        'expired_at',
    ];

    public static function realty_list_widget($shortcode_args) {
        $template = $shortcode_args['templage'] ?? 'list';
        $start = $shortcode_args['start'] ?? 0;
        $limit = $shortcode_args['limit'] ?? 10;
        $author_id = $shortcode_args['author_id'] ?? null;
        $ajax_url = $shortcode_args['ajax_url'] ?? null;

        $realtys = null;
        $realtys = Realty::with('info', 'attachments')->where('status', 'published');

        if ($author_id) {
            $realtys = $realtys->where('author_id', $author_id);
        }

        $realtys = $realtys->orderBy('id', 'desc')->offset($start)->take($limit)->get();

        if ($realtys->count() === 0) {
            $realtys = null;
        }

        $city_kladrs = [];
        foreach ($realtys as $realty) {
            if (isset($realty->city)) {
                $city_kladrs[] = $realty->city;
            }
        }

        if (!empty($city_kladrs)) {
            $city_kladrs = Kladr::city_by_kladrs($city_kladrs);
            foreach ($realtys as $realty) {
                if (isset($city_kladrs[$realty->city])) {
                    $realty->city = $city_kladrs[$realty->city];
                }
            }
        }

        $data = compact(
            'realtys',
            'limit',
            'author_id',
            'ajax_url'
        );

        return view('/realty/' . $template, $data)->render();
    }

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function type() {
        return $this->hasOne('App\Models\Realty\RealtyType', 'id', 'type_id');
    }

    public function dop_type() {
        return $this->hasOne('App\Models\Realty\RealtyDopType', 'id', 'dop_type_id');
    }

    public function room_type() {
        return $this->hasOne('App\Models\Realty\RealtyRoomType', 'id', 'room_type_id');
    }

    public function trade_type() {
        return $this->hasOne('App\Models\Realty\RealtyTradeType', 'id', 'trade_type_id');
    }

    public function rent_duration() {
        return $this->hasOne('App\Models\Realty\RealtyRentDuration', 'id', 'rent_duration_id')->name;
    }

    public function info() {
        return $this->hasMany('App\Models\Realty\RealtyInfo', 'realty_id');
    }

    public function comfort() {
        return $this->belongsToMany('App\Models\Realty\RealtyComfort', 'realty_entry_comfort', 'realty_id', 'comfort_id');
    }

    public function attachments() {
        return $this->belongsToMany('App\Models\Blog\Attachments', 'realty_entry_attachments', 'entry_id', 'attachment_id')->orderBy('realty_entry_attachments.sort', 'asc')->withPivot('type');
    }

    /*
     * *******************************************************
     * Shortcodes
     * *******************************************************
     */

    private static function DESIGN_FORMAT_CATS($cats) {
        $result = [];

        if (!empty($cats)) {
            $first = $cats->shift();
            $result[] = $first;
            $result[] = collect(null);
            $result[] = collect(null);

            $chunk = $cats->chunk(3);

            $result = collect($result);
            $result = $chunk->prepend($result);
        }

        return $result;
    }

    // Виджет для вывода списка объявлений
    public static function realty_list_shortcode($args) {
        return self::realty_list_widget($args);
    }

    public static function realty_cats_list_shortcode($args) {
        $types = RealtyType::realty_type($args);
        $room_types = RealtyRoomType::realty_room_type($args);

        $types = self::DESIGN_FORMAT_CATS($types);
        $room_types = self::DESIGN_FORMAT_CATS($room_types);

        $args = shortcode_args_to_string($args);
        return view('shortcodes.realty.realty_cats_list', compact('types', 'room_types', 'args'));
    }

}
