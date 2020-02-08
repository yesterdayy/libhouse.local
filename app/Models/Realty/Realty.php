<?php

namespace App\Models\Realty;

use App\Models\Kladr\Kladr;
use App\Models\User\UserRealtyFavorite;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

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
            if (Auth::check()) {
                $query->author_id = Auth::user()->getAuthIdentifier();
            }
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

    protected $dates = [
        'expired_at',
    ];

    const SORT_VARIANTS = [
        'default' => 'по умолчанию',
        'price_asc' => 'по цене (сначала дешевле)',
        'price_desc' => 'по цене (сначала дороже)',
        'square_desc' => 'по общей площади',
    ];

    public static function realty_widget($shortcode_args) {
        $start = $shortcode_args['start'] ?? 0;
        $limit = $shortcode_args['limit'] ?? 9;
        $start = Request::get('page') ? (Request::get('page') - 1) * $limit : $start;

        $realtys = Realty::with('info', 'attachments');

        $realtys = $realtys->orderBy('id', 'desc')->offset($start)->paginate($limit);
        $realtys = self::get_realty_cities($realtys);

        $realty_ids = [];
        foreach ($realtys as $realty) {
            $realty->info_arr = $realty->info->pluck('value', 'field');
            $realty_ids[] = $realty->id;
        }

        // Берем избранные посты
        $favorites = UserRealtyFavorite::select('realty_id')->where('user_id', Auth::id())->whereIn('realty_id', $realty_ids)->pluck('realty_id')->toArray();
        foreach ($realtys as $realty) {
            if (in_array($realty->id, $favorites)) {
                $realty->is_favorite = true;
            } else {
                $realty->is_favorite = false;
            }
        }

        $data = compact(
            'realtys'
        );

        return $data;
    }

    public static function realty_search_widget($shortcode_args) {
        $realtys = RealtyFilter::getRealty(Request::all());
        $realtys = self::get_realty_cities($realtys);

        $data = compact(
            'realtys'
        );

        return $data;
    }

    public static function realty_author_widget($shortcode_args) {
        if (!isset($shortcode_args['author_id'])) {
            return false;
        }

        $start = $shortcode_args['start'] ?? 0;
        $limit = $shortcode_args['limit'] ?? 9;
        $start = Request::get('page') ? (Request::get('page') - 1) * $limit : $start;
        $author_id = $shortcode_args['author_id'];

        $realtys = Realty::with('info', 'attachments');
        $realtys = $realtys->where('author_id', $author_id);

        // Если кнопочный фильтр
        // как в профиле - объявления
        if (isset($shortcode_args['btn_filter'])) {
            switch ($shortcode_args['btn_filter']) {
                case 'active':
                    $realtys = $realtys->where('status', 'published')->where('expired_at', '>', Carbon::today());
                    break;

                case 'no_active':
                    $realtys = $realtys->where('status', 'published')->where('expired_at', '<=', Carbon::today());
                    break;

                case 'blocked':
                    $realtys = $realtys->where('status', 'blocked');
                    break;

                case 'draft':
                    $realtys = $realtys->where('status', 'draft');
                    break;
            }
        } else {
            $realtys = $realtys->where('status', 'published');
        }

        $realtys = $realtys->orderBy('id', 'desc')->offset($start)->paginate($limit);
        $realtys = self::get_realty_cities($realtys);

        $data = compact(
            'realtys'
        );

        return $data;
    }

    public static function realty_favorite_widget($shortcode_args) {
        if (!isset($shortcode_args['user_id'])) {
            return false;
        }

        $start = $shortcode_args['start'] ?? 0;
        $limit = $shortcode_args['limit'] ?? 9;
        $start = Request::get('page') ? (Request::get('page') - 1) * $limit : $start;
        $user_id = $shortcode_args['user_id'];

        $favorite_ids = UserRealtyFavorite::select('realty_id')->where('user_id', $user_id)->get()->toArray();

        if (empty($favorite_ids)) {
            return 'У вас ещё нет избранных';
        }

        $realtys = Realty::with('info', 'attachments');
        $realtys = $realtys->whereIn('id', $favorite_ids);
        $realtys = $realtys->where('status', 'published');
        $realtys = $realtys->orderBy('id', 'desc')->offset($start)->paginate($limit);
        $realtys = self::get_realty_cities($realtys);

        foreach ($realtys as $realty) {
            $realty->info_arr = $realty->info->pluck('value', 'field');
        }

        $data = compact(
            'realtys'
        );

        return $data;
    }

    public static function info_format (Realty $realty) {
        $result = [];
        $info = $realty->info->pluck('value', 'field');

        $result[]['Количество комнат'] = $realty->room_type->name;

        if (isset($info['floor'])) {
            $result[]['Этаж'] = $info['floor'];
        }

        if (isset($info['floors'])) {
            $result[]['Этажей в доме'] = $info['floors'];
        }

        if (isset($realty->house_class_id) && $realty->house_class_id > 0) {
            $result[]['Класс здания'] = $realty->house_class->name;
        }

        if (isset($info['square_common'])) {
            $result[]['Общая площадь'] = $info['square_common'] . ' м2';
        }

        if (isset($info['square_living'])) {
            $result[]['Жилая площадь'] = $info['square_living'] . ' м2';
        }

        if (isset($info['square_kitchen'])) {
            $result[]['Площадь кухни'] = $info['square_kitchen'] . ' м2';
        }

        $result[]['Категория'] = $realty->dop_type->name;

        // Строим структуру для таблицы

        $result_table = [];
        if (count($result) > 0) {
            if (count($result) > 3) {
                $cols = ceil(count($result) / 3);

                for ($i = 0; $i < 3; $i++) {
                    $result_table[$i][key($result[$i])] = head($result[$i]);
                    for ($j = 1; $j <= $cols; $j++) {
                        $k = $i + ($j * 3);
                        if (isset($result[$k])) {
                            $result_table[$i][key($result[$k])] = head($result[$k]);
                        }
                    }
                }
            }
            else {
                $tmp = [];
                foreach ($result as $res) {
                    $tmp[key($res)] = current($res);
                }
                $result_table[0] = $tmp;
            }
        }

        return collect($result_table);
    }

    public static function get_title($request) {
        $trade_type = RealtyTradeType::findOrFail($request['trade_type'])->name_autocreate;
        if ($request['trade_type'] == 1) {
            $duration = RealtyRentDuration::withoutGlobalScopes()->findOrFail($request['duration'])->name_autocreate;
        }
        $type = RealtyType::findOrFail($request['type'])->name_autocreate;
        $street = (!empty($request['address_street']) ? Kladr::get_street_by_kladr($request['address_street']) : null);
        $street = ($street ? $street->SOCR . '. ' . $street->NAME : '');

        // Если аренда
        if ($request['trade_type'] == 1) {
            $result = $trade_type . ' ' . $duration . ' ' . $type . ', ' . $street;
        }
        // Если продажа
        else {
            $result = $trade_type . ' ' . $type . $street;
        }

        return $result;
    }

    public static function pick_filters($data, $request = null) {
        $filter = isset($request) ? $request : Input::toArray();
        $data['pick_filters'] = [];

//        if ($filter['header_address_city']) {
//            $data['pick_filters']['header_address_city'] = Kladr::get_city_by_kladr($filter['header_address_city']);
//        }
//
//        if ($filter['header_address_street']) {
//            $data['pick_filters']['header_address_street'] = Kladr::get_street_by_kladr($filter['header_address_street']);
//        }

        if ($filter['trade_type']) {
            $filter['trade_name'] = RealtyTradeType::select('name')->find($filter['trade_type']);
            $data['pick_filters']['trade_type'] = $filter['trade_name']->name;
        }

        if ($filter['type']) {
            $names = [];
            $types = RealtyType::select('id', 'name')->whereIn('id', $filter['type'])->get();
            foreach ($types as $type) {
                $names[] = [
                    'id' => $type->id,
                    'val' => $type->name
                ];
            }

            $data['pick_filters']['type'] = $names;
            unset($names);
        }

        if ($filter['room_type']) {
            $names = [];
            $room_types = RealtyRoomType::select('id', 'name')->whereIn('id', $filter['room_type'])->get();
            foreach ($room_types as $room_type) {
                $names[] = [
                    'id' => $room_type->id,
                    'val' => $room_type->name
                ];
            }

            $data['pick_filters']['room_type'] = $names;
            unset($names);
        }

        if ($filter['dop_type']) {
            $filter['dop_type_name'] = RealtyDopType::select('id', 'name')->find($filter['dop_type']);
            $data['pick_filters']['dop_type'] = $filter['dop_type_name']->name;
        }

        if ($filter['price_start']) {
            $data['pick_filters']['price_start'] = 'от ' . $filter['price_start'] . ' руб.';
        }

        if ($filter['price_end']) {
            $data['pick_filters']['price_end'] = 'до ' . $filter['price_end'] . ' руб.';
        }

        return $data;
    }

    public static function get_btn_filters_count(int $author_id): array {
        $user_realties = Realty::select('id', 'status', 'expired_at')->where('author_id', $author_id)->get();

        $counts = [
            'active' => 0,
            'no_active' => 0,
            'blocked' => 0,
            'draft' => 0,
        ];

        foreach ($user_realties as $realty) {
            if ($realty->expired_at < date('Y-m-d H:i:s')) {
                $counts['no_active']++;
            }

            switch($realty->status) {
                case 'published':
                    if ($realty->expired_at > date('Y-m-d H:i:s')) {
                        $counts['active']++;
                    }
                    break;

                case 'blocked':
                    $counts['blocked']++;
                    break;

                case 'draft':
                    $counts['draft']++;
                    break;
            }
        }

        return $counts;
    }

    // Дублю для обработки url-ов по категориям
    public static function filter_middleware($request) {
        $request['start'] = isset($request['start']) ? clear_string($request['start']) : 0;
        $request['length'] = isset($request['length']) ? clear_string($request['length']) : 10;

        $request['term'] = isset($request['term']) ? clear_string($request['term']) : null;
        $request['address'] = isset($request['address']) ? clear_string($request['address']) : null;
        $request['header_address_city'] = isset($request['header_address_city']) ? clear_numeric($request['header_address_city']) : null;
        $request['header_address_street'] = isset($request['header_address_street']) ? clear_numeric($request['header_address_street']) : null;
        $request['trade_type'] = isset($request['trade_type']) ? clear_numeric($request['trade_type']) : null;
        $request['rent_duration'] = isset($request['rent_duration']) ? clear_numeric($request['rent_duration']) : null;
        $request['dop_type'] = isset($request['dop_type']) ? clear_numeric($request['dop_type']) : null;
        $request['price_start'] = isset($request['price_start']) ? clear_numeric($request['price_start']) : null;
        $request['price_end'] = isset($request['price_end']) ? clear_numeric($request['price_end']) : null;
        $request['city'] = isset($request['city']) ? clear_string($request['city']) : null;
        $request['street'] = isset($request['street']) ? clear_string($request['street']) : null;

        $request['type'] = isset($request['type']) ? explode(',', $request['type']) : null;
        if ($request['type']) {
            $request['type'] = array_filter(array_map(function ($type) {
                return clear_numeric($type);
            }, $request['type']));
            if (empty($request['type'])) {
                $request['type'] = false;
            }
        }

        $request['room_type'] = isset($request['room_type']) ? explode(',', $request['room_type']) : null;
        if ($request['room_type']) {
            $request['room_type'] = array_filter(array_map(function ($room_type) {
                return clear_numeric($room_type);
            }, $request['room_type']));
            if (empty($request['room_type'])) {
                $request['room_type'] = false;
            }
        }

        if (isset($request['sort'])) {
            $request['sort'] = clear_string($request['sort']);
            if (!$request['sort']) {
                $request['sort'] = 'default';
            }
        } else {
            $request['sort'] = 'default';
        }

        return $request;
    }

    public static function get_realty_cities($realtys) {
        $city_kladrs = [];
        foreach ($realtys as $realty) {
            if (isset($realty->city)) {
                $city_kladrs[] = $realty->city;
            }
        }

        if (!empty($city_kladrs)) {
            $city_kladrs = array_unique($city_kladrs);
            $city_kladrs = Kladr::city_by_kladrs($city_kladrs);
            foreach ($realtys as $realty) {
                if (isset($city_kladrs[$realty->city])) {
                    $realty->city = $city_kladrs[$realty->city];
                }
            }
        }

        return $realtys;
    }

    public static function route_cache() {
        $routes = [
            'trade_type' => RealtyTradeType::select('id', 'slug')->get()->pluck('id', 'slug'),
            'type' => RealtyType::select('id', 'slug')->get()->pluck('id', 'slug'),
            'room_type' => RealtyRoomType::select('id', 'slug')->get()->pluck('id', 'slug'),
            'dop_type' => RealtyDopType::select('id', 'slug')->get()->pluck('id', 'slug'),
            'rent_duration' => RealtyRentDuration::select('id', 'slug')->get()->pluck('id', 'slug'),
        ];

        Cache::forever('routes', $routes);
        return $routes;
    }

    public static function getBreadCrumbs($realty) {
        $breadcrumbs = [];

        if (isset($realty->city) && $realty->city) {
            $city = Kladr::get_city_by_kladr($realty->getOriginal('city'));

            if (!empty($city)) {
                $breadcrumbs[] = [
                    'name' => $realty->city,
                    'slug' => $city->SLUG,
                ];
            }
        }

        if (isset($realty->street) && $realty->street) {
            $street = Kladr::get_street_by_kladr($realty->getOriginal('street'));

            if (!empty($street)) {
                $breadcrumbs[] = [
                    'name' => $realty->street,
                    'slug' => $street->SLUG,
                ];
            }
        }

        if (isset($realty->type->name) && $realty->type->name) {
            $breadcrumbs[] = [
                'name' => $realty->type->name,
                'slug' => $realty->type->slug,
            ];
        }

        if (isset($realty->trade_type->name_alt) && $realty->trade_type->name_alt) {
            $breadcrumbs[] = [
                'name' => $realty->trade_type->name_alt,
                'slug' => $realty->trade_type->slug,
            ];
        }

        if (isset($realty->room_type->name) && $realty->room_type->name) {
            $breadcrumbs[] = [
                'name' => $realty->room_type->name,
                'slug' => $realty->room_type->slug,
            ];
        }

        if (isset($realty->dop_type->name) && $realty->dop_type->name) {
            $breadcrumbs[] = [
                'name' => $realty->dop_type->name,
                'slug' => $realty->dop_type->slug,
            ];
        }

        return $breadcrumbs;
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

    public function house_class() {
        return $this->hasOne('App\Models\Realty\RealtyHouseClass', 'id', 'house_class_id');
    }

    public function info() {
        return $this->hasMany('App\Models\Realty\RealtyInfo', 'realty_id');
    }

    public function comfort() {
        return $this->belongsToMany('App\Models\Realty\RealtyComfort', 'realty_entry_comfort', 'realty_id', 'comfort_id');
    }

    public function author() {
        return $this->hasOne('App\Models\User\User', 'id', 'author_id');
    }

    public function attachments() {
        return $this->belongsToMany('App\Models\Blog\Attachments', 'realty_entry_attachments', 'entry_id', 'attachment_id')->orderBy('realty_entry_attachments.sort', 'asc')->withPivot('type');
    }

    public function counters() {
        return $this->hasOne('App\Models\Realty\RealtyCounters', 'realty_id', 'id');
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
    public static function realty_shortcode($args) {
        $data = self::realty_widget($args);
        return view('realty.loops.list', $data)->render();
    }

    // Виджет для поиска объявлений
    public static function realty_search_shortcode($args) {
        $data = self::realty_search_widget($args);

        // подтягивать выбранные фильтры и сортировку
        $data = self::pick_filters($data);
        $data['sort_variants'] = self::SORT_VARIANTS;
        $data['sort_by'] = Input::get('sort');

        return view('realty.loops.search_list', $data)->render();
    }

    // Виджет для вывода списка объявлений автора
    public static function realty_author_shortcode($args) {
        $data = self::realty_author_widget($args);
        if (isset($data['realtys'])) {
            return view('realty.loops.author_list', $data)->render();
        } else {
            return $data;
        }
    }

    // Виджет для вывода списка избранных объявлений
    public static function realty_favorite_shortcode($args) {
        $data = self::realty_favorite_widget($args);
        if (isset($data['realtys'])) {
            return view('realty.loops.favorite_list', $data)->render();
        } else {
            return $data;
        }
    }

    public static function realty_cats_shortcode($args) {
        $types = RealtyType::realty_type($args);
        $room_types = RealtyRoomType::realty_room_type($args);

        $types = self::DESIGN_FORMAT_CATS($types);
        $room_types = self::DESIGN_FORMAT_CATS($room_types);

        $args = shortcode_args_to_string($args);
        return view('shortcodes.realty.realty_cats_list', compact('types', 'room_types', 'args'));
    }

}
