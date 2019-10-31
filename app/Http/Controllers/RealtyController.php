<?php

namespace App\Http\Controllers;

use App\Models\Realty\Realty;
use App\Models\Realty\RealtyComfort;
use App\Models\Realty\RealtyComfortCat;
use App\Models\Realty\RealtyDopType;
use App\Models\Realty\RealtyInfo;
use App\Models\Realty\RealtyRentDuration;
use App\Models\Realty\RealtyRoomType;
use App\Models\Realty\RealtyTradeType;
use App\Models\Realty\RealtyType;
use App\Models\Kladr\Kladr;
use App\Models\User\UserRealtyType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RealtyController extends Controller
{

    public function index() {
        $realtys = Realty::with('info', 'photos')->where('is_moderated', '1')->orderBy('id', 'desc')->take(20)->get();
        return view('realty/list', compact('realtys'));
    }

    public function show($slug) {
        $realty = Realty::with('info', 'comfort', 'attachments')->whereSlug($slug)->firstOrFail();
        return view('realty/single', compact('realty'));
    }

    public function create() {
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

        $user_realty_types = UserRealtyType::all();
        return view('realty/add', compact(
            'comforts',
            'rent_types',
            'types',
            'dop_types',
            'room_types',
            'trade_types',
            'rent_durations',
            'user_realty_types'
        ));
    }

    public function edit($slug) {
        $realty = Realty::with('info', 'comfort', 'attachments')->whereSlug($slug)->firstOrFail();
        $this->authorize('edit', $realty);

        $realty->info = $realty->info->pluck('value', 'field');
        $realty->info['city_val'] = isset($realty->info['city']) ? Kladr::get_city_by_kladr($realty->info['city']) : null;
        $realty->info['street_val'] = isset($realty->info['street']) ? Kladr::get_street_by_kladr($realty->info['street']) : null;
        $realty->comfort = $realty->comfort->pluck('name', 'id');

        $comforts = RealtyComfort::all();
        $type = RealtyType::all()->pluck('name', 'id');
        $rent_duration = RealtyRentDuration::all()->pluck('name', 'id');
        return view('realty/edit', compact('realty', 'comforts', 'type', 'rent_duration'));
    }

    public function store(Request $request, $slug = null) {
        $input = $request->all();

        if ($slug) {
            $realty = Realty::whereSlug($slug)->firstOrFail();
            if ($realty->count() > 0) {
                $this->authorize('edit', $realty);
            }
        } else {
            $this->authorize('create', Realty::class);
            $realty = new Realty();
        }
        $realty->title = $input['title'];
        $realty->type = $input['type'];
        $realty->content = $input['content'];
        $realty->price = $input['price'];
        if ($input['type'] == RealtyType::ARENDA_ID) {
            $realty->rent_duration = $input['rent_duration'];
        } else {
            $realty->rent_duration = RealtyRentDuration::EMPTY_DURATION_ID;
        }
        $realty->slug = $realty->slug ?? Str::slug($input['title']) . '-' . Str::random(6);
        $realty->save();

        if (isset($input['info'])) {
            $insert_info = [];
            foreach ($input['info'] as $k => $info) {
                if (!empty($info)) {
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
                $insert_photos[] = $photo;
            }
            unset($k, $photo);
            $realty->photos()->attach($insert_photos);
        }

    }

    public function update(Request $request, $slug) {
        $this->store($request, $slug);
        return redirect()->route('realty_edit', $slug);
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
