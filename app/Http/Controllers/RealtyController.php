<?php

namespace App\Http\Controllers;

use App\Components\Shortcodes;
use App\Http\Requests\RealtyFormRequest;
use App\Models\Blog\Attachments;
use App\Models\Realty\Realty;
use App\Models\Realty\RealtyComfort;
use App\Models\Realty\RealtyComfortCat;
use App\Models\Realty\RealtyCounters;
use App\Models\Realty\RealtyDopType;
use App\Models\Realty\RealtyHouseClass;
use App\Models\Realty\RealtyInfo;
use App\Models\Realty\RealtyRentDuration;
use App\Models\Realty\RealtyRoomType;
use App\Models\Realty\RealtyTradeType;
use App\Models\Realty\RealtyType;
use App\Models\Kladr\Kladr;
use App\Models\User\UserRealtyFavorite;
use App\Models\User\UserRealtyType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class RealtyController extends Controller
{

    public function index() {
        return view('home');
    }

    public function search(Request $request) {
        $realtys = Realty::with('info', 'attachments', 'counters')->where('status', 'published')->orderBy('id', 'desc')->take(20)->get();

        $filter = Input::toArray();
        $pick_filters = [];

        if ($filter['trade_type']) {
            $filter['trade_name'] = RealtyTradeType::select('name')->find($filter['trade_type']);
            $pick_filters[] = $filter['trade_name']->name;
            $filter['trade_name'] = $filter['trade_name'] ? mb_substr($filter['trade_name']->name, 0, 6) : null;
        }

        if ($filter['type']) {
            $names = [];
            $types = RealtyType::select('name')->whereIn('id', $filter['type'])->get();
            foreach ($types as $type) {
                $names[] = $type->name;
            }

            $filter['type_name'] = mb_substr(implode(',', $names), 0, 8);
            $pick_filters[] = $names;
            unset($names);
        }

        if ($filter['room_type']) {
            $names = [];
            $room_types = RealtyRoomType::select('name')->whereIn('id', $filter['room_type'])->get();
            foreach ($room_types as $room_type) {
                $names[] = $room_type->name;
            }

            $filter['room_type_name'] = mb_substr(implode(',', $names), 0, 6);
            $pick_filters[] = $names;
            unset($names);
        }

        if ($filter['dop_type']) {
            $filter['dop_type_name'] = RealtyDopType::select('name')->find($filter['dop_type']);
            $pick_filters[] = $filter['dop_type_name']->name;
            $filter['dop_type_name'] = $filter['dop_type_name'] ? mb_substr($filter['dop_type_name']->name, 0, 24) : null;
        }

        if ($filter['price_start']) {
            $pick_filters[] = 'от ' . $filter['price_start'] . ' руб.';
        }

        if ($filter['price_end']) {
            $pick_filters[] = 'до ' . $filter['price_end'] . ' руб.';
        }

        if ($request->ajax()) {
            $result = [];
            $result['html'] = shortcodes_parse(view('realty.search', compact(
                'realtys',
                'filter'
            ))->render());

            return response()->json($result);
        } else {
            return view('realty.search', compact(
                'realtys',
                'filter',
                'pick_filters'
            ));
        }
    }

    public function cabinet_search($user_id) {
        $term = clear_string(request()->get('term'));

        if (!empty($user_id) && !empty($term)) {
            $shortcode_args = [
                'template' => 'search',
            ];

            $realtys = Realty::where('author_id', $user_id)->where('title', 'like', '%' . $term . '%')->paginate(5);

            // Берем избранные посты
            $realty_ids = [];
            foreach ($realtys as $realty) {
                $realty_ids[] = $realty->id;
            }

            $favorites = UserRealtyFavorite::select('realty_id')->where('user_id', Auth::id())->whereIn('realty_id', $realty_ids)->pluck('realty_id')->toArray();
            foreach ($realtys as $realty) {
                if (in_array($realty->id, $favorites)) {
                    $realty->is_favorite = true;
                } else {
                    $realty->is_favorite = false;
                }
            }

            return view('realty.loops.favorite_list', [
                'realtys' => $realtys,
                'shortcode_args' => $shortcode_args,
            ]);
        }
    }

    public function show($slug) {
        $realty = Realty::with('info', 'comfort', 'attachments', 'dop_type', 'author', 'counters')->whereSlug($slug)->where('status', 'published')->firstOrFail();

        if ($realty->counters) {
            $realty->counters->increment('counter');
            $realty->counters->save();
        } else {
            $counters = new RealtyCounters(['realty_id' => $realty->id, 'counter' => 1]);
            $realty->counters()->save($counters);
            $realty->counters = $counters;
        }

        $realty_next = Realty::select('slug')->where('id', '>', $realty->id)->where('status', 'published')->first();
        if ($realty_next) {
            $realty_next = $realty_next->slug;
        }

        $realty_info = $realty->info->pluck('value', 'field');
        $realty_info_table = Realty::info_format($realty);

        foreach ($realty_info as $k => $inf) {
            if (strpos($inf, '||') !== false) {
                $realty_info[$k] = explode('||', $inf);
            }
        }

        $comforts_cats = RealtyComfortCat::all()->pluck('name', 'id');
        $comforts_tmp = RealtyComfort::all();
        $comforts = [];
        foreach ($comforts_tmp as $comfort) {
            $comforts[$comforts_cats[$comfort->cat_id]][] = $comfort;
        }
        unset($comforts_cats, $comforts_tmp);

        if ($realty->comfort->count() > 0) {
            $selected_comforts = $realty->comfort->pluck('name', 'id');
            foreach ($comforts as $comfort) {
                foreach ($comfort as $item) {
                    if (isset($selected_comforts[$item->id])) {
                        $item->selected = true;
                    }
                }
            }
        }

        // Берем инфу избранный он или нет
        $is_favorite = UserRealtyFavorite::select('realty_id')->where('user_id', Auth::id())->where('realty_id', $realty->id)->first();
        if ($is_favorite) {
            $realty->is_favorite = true;
        } else {
            $realty->is_favorite = false;
        }

        return view('realty/templates/single', compact(
            'realty',
            'realty_next',
            'realty_info',
            'realty_info_table',
            'comforts'
        ));
    }

    public function create(Request $request) {
        $comforts_cats = RealtyComfortCat::all()->pluck('name', 'id');
        $comforts_tmp = RealtyComfort::all();
        $comforts = [];
        foreach ($comforts_tmp as $comfort) {
            $comforts[$comforts_cats[$comfort->cat_id]][] = $comfort;
        }
        unset($comforts_cats, $comforts_tmp);

        $rent_types = collect([
            (object) [
                'id' => 0,
                'name' => 'Жилая'
            ],
            (object) [
                'id' => 1,
                'name' => 'Коммерческая'
            ],
        ]);
        $types = RealtyType::all();
        $dop_types = RealtyDopType::all();
        $room_types = RealtyRoomType::all();
        $trade_types = RealtyTradeType::all();
        $rent_durations = RealtyRentDuration::all();
        $house_classes = RealtyHouseClass::all();

        $photos = [];
        if (!empty($request->old('photos'))) {
            $photos = Attachments::whereIn('id', $request->old('photos'))->get();
        } else {
            $photos = collect($photos);
        }

        $old = $request->old();

        $user_realty_types = UserRealtyType::where('id', '>', '0')->get();
        return view('realty/add', compact(
            'comforts',
            'rent_types',
            'types',
            'dop_types',
            'room_types',
            'trade_types',
            'rent_durations',
            'user_realty_types',
            'house_classes',
            'fields_ru',
            'photos',
            'old'
        ));
    }

    public function edit($slug) {
        $realty = Realty::with('info', 'comfort', 'attachments')->whereSlug($slug)->firstOrFail();
        $this->authorize('edit', $realty);

        $realty->info = $realty->info->pluck('value', 'field');
        $realty->info['city_val'] = isset($realty->info['city']) ? Kladr::get_city_by_kladr($realty->info['city']) : null;
        $realty->info['street_val'] = isset($realty->info['street']) ? Kladr::get_street_by_kladr($realty->info['street'])->NAME : null;
        $realty->comfort = $realty->comfort->pluck('name', 'id');

        $comforts = RealtyComfort::all();
        $type = RealtyType::all()->pluck('name', 'id');
        $rent_duration = RealtyRentDuration::all()->pluck('name', 'id');
        return view('realty/edit', compact('realty', 'comforts', 'type', 'rent_duration'));
    }

    public function store(RealtyFormRequest $request, $slug = null) {
        $input = $request->all();

        if ((isset($input['user_realty_type']) || isset($input['phone']) || isset($input['email'])) && Auth::check()) {
            $user = Auth::user();
            if (isset($input['email']) && !empty($input['email'])) {
                $user->email = $input['email'];
            }
            if (isset($input['phone']) && !empty($input['phone'])) {
                $user->phone = $input['phone'];
            }
            if (isset($input['user_realty_type']) && !empty($input['user_realty_type'])) {
                $user->realty_type_id = $input['user_realty_type'];
            }
            $user->save();
        }

        if ($slug) {
            $realty = Realty::whereSlug($slug)->firstOrFail();
            if ($realty->count() > 0) {
                $this->authorize('edit', $realty);
            }
        } else {
            // $this->authorize('create', Realty::class);
            $realty = new Realty();
        }

        $realty->title = isset($input['title']) && !empty($input['title']) ? $input['title'] : Realty::get_title($input);
        $realty->type_id = $input['type'];
        $realty->dop_type_id = $input['dop_type'];
        $realty->room_type_id = $input['room_type'];
        $realty->trade_type_id = $input['trade_type'];
        $realty->rent_duration_id = $input['duration'];
        $realty->house_class_id = $input['house_class'] ?? null;
        $realty->city = $input['address_city'];
        $realty->street = $input['address_street'];
        $realty->content = strip_tags($input['content']);
        $realty->price = $input['price'];
        $realty->slug = $realty->slug ?? Str::slug($realty->title . '-' . Str::random(6));
        $realty->status = 'published';
        $realty->save();

        if (isset($input['info'])) {
            $insert_info = [];
            foreach ($input['info'] as $k => $info) {
                if (!empty($info)) {
                    if (is_array($info)) {
                        $info = strip_tags(implode('||', $info));
                    }

                    $insert_info[] = [
                        'realty_id' => $realty->id,
                        'field' => $k,
                        'value' => $info,
                    ];
                }
            }
            unset($k, $info);
            if ($slug) {
                RealtyInfo::where('realty_id', $realty->id)->delete();
            }
            RealtyInfo::insert($insert_info);
        }

        if (isset($input['comfort'])) {
            $insert_comfort = [];
            foreach ($input['comfort'] as $k => $comfort) {
                $insert_comfort[] = $k;
            }
            unset($k, $comfort);
            $realty->comfort()->attach($insert_comfort);
        }
        if (isset($input['photos'])) {
            $insert_photos= [];
            foreach ($input['photos'] as $k => $photo) {
                if (!empty($photo)) {
                    $insert_photos[] = [
                        'type' => 'photo',
                        'attachment_id' => $photo,
                    ];
                }
            }
            unset($k, $photo);
            $realty->attachments()->attach($insert_photos);
        }

        $counters = new RealtyCounters(['realty_id' => $realty->id, 'counter' => 0]);
        $realty->counters()->save($counters);

        return response()->redirectToRoute('realty.show', $realty->slug);
    }

    public function update(Request $request, $slug) {
        $this->store($request, $slug);
        return redirect()->route('realty_edit', $slug);
    }

    public function favorite($realty_id) {
        if (Auth::check()) {
            $favorite_exists = UserRealtyFavorite::where('user_id', Auth::id())->where('realty_id', $realty_id)->first();

            if (!$favorite_exists) {
                UserRealtyFavorite::create([
                    'user_id' => Auth::id(),
                    'realty_id' => $realty_id,
                    'created_at' => Carbon::now()
                ]);
                $status = 'success';
                $message = 'Добавлено в избранное';
                $dop_params = ['create' => 1];
            } else {
                $favorite_exists->forceDelete();
                $status = 'success';
                $message = 'Удалено из избранного';
                $dop_params = ['remove' => 1];
            }

            return toast_response($status, $message, $dop_params);
        } else {
            return toast_response('error', 'Авторизуйтесь на сайте.');
        }
    }

    public function change_active_status($realty_id) {
        $realty = Realty::findOrFail($realty_id);
        $this->authorize('edit', $realty);

        if ($realty->is_active == 0) {
            list($status, $message) = $this->activate($realty);
        } else {
            list($status, $message) = $this->deactivate($realty);
        }

        return toast_response($status, $message);
    }

    private function activate($realty) {
        $realty->is_active = 1;
        $realty->save();

        $status = 'success';
        $message = 'Объявление активировано';
        if (!$realty) {
            $status = 'error';
            $message = 'Произошла ошибка. Повторите позже';
        }
        return [$status, $message];
    }

    private function deactivate($realty) {
        $realty->is_active = 0;
        $realty->save();

        $status = 'success';
        $message = 'Объявление деактивировано';
        if (!$realty) {
            $status = 'error';
            $message = 'Произошла ошибка. Повторите позже';
        }
        return [$status, $message];
    }

    public function renew($realty_id) {
        $new_expired_at = Carbon::now()->addMonthsNoOverflow(1)->toDateTimeString();
        $realty = Realty::whereId($realty_id)->update(['expired_at' => $new_expired_at]);
        $this->authorize('edit', $realty);
        $status = 'success';
        $message = "Объявление продлено до $new_expired_at";
        if (!$realty) {
            $status = 'error';
            $message = 'Произошла ошибка. Повторите позже';
        }
        return toast_response($status, $message);
    }

    public function get_realty_list_widget(Request $request) {
        return Realty::realty_list_shortcode($request);
    }

}
