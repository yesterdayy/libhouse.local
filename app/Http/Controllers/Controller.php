<?php

namespace App\Http\Controllers;

use App\Components\Shortcodes;
use App\Models\Realty\RealtyDopType;
use App\Models\Realty\RealtyRoomType;
use App\Models\Realty\RealtyServiceType;
use App\Models\Realty\RealtyTradeType;
use App\Models\Realty\RealtyType;
use App\Models\Kladr\Kladr;
use App\Models\Modal\Modal;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cookie;
use IPGeoBase;

class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        view()->share('page_title', $this->page_title[request()->route()->getActionMethod()] ?? '');

        $page_class = $this->getPageClass();
        view()->share('page_class', $page_class);

        $modals = $this->getModals();
        view()->share('modals', $modals);

        view()->share('realty_types', RealtyType::all());
        view()->share('realty_dop_types', RealtyDopType::all());
        view()->share('realty_trade_types', RealtyTradeType::all());
        view()->share('realty_room_types', RealtyRoomType::all());

        view()->share('popular_cities', Kladr::get_popular_cities(4));

        if (!Cookie::has('city')) {
            $geo = new IPGeoBase();
            $city = $geo->getRecord($_SERVER['REMOTE_ADDR'])['city'];
            if (!$city) {
                $city = 'Симферополь';
            }
            view()->share('city', $city);
        } else {
            view()->share('city', Cookie::get('city'));
        }

    }

    private function getPageClass() {
        $page_class_info = basename(request()->route()->getAction()['controller']);
        $page_class_info = explode('@', $page_class_info);
        $page_class = str_replace('Controller', '', $page_class_info[0]);
        $page_class = strtolower($page_class) . ' ' . strtolower($page_class) . (isset($page_class_info[1]) && !empty(trim($page_class_info[1])) ? '-' . strtolower($page_class_info[1]) : '');
        $page_class = str_replace('_', '-', $page_class);
        return $page_class;
    }

    private function getModals() {
        $modals = Modal::where('status', '1')->get();
        foreach ($modals as $k => $modal) {
            $modals[$k]->content = str_replace(["\r\n", '  '], "", Shortcodes::parseShortcodes($modal->content));
        }
        return $modals->toJson(JSON_UNESCAPED_UNICODE);
    }
}
