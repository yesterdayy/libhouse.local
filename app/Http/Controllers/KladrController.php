<?php

namespace App\Http\Controllers;

use App\Models\Kladr\Kladr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KladrController extends Controller
{

    private $default_region = '91';

    public function city(Request $request) {
        $result = [];

        if (!empty($request->get('term'))) {
            $limit = 4;

            $data = Kladr::city($request->get('term'), 91, $limit, false);

            foreach ($data as $item) {
                $result[] = [
                    'value' => $item->CITY_NAME,
                    'data' => [
                        'city_kladr' => $item->CITY_CODE,
                    ]
                ];
            }

            $result = ['suggestions' => $result];
        }

        return response()->json($result);
    }

    public function street(Request $request) {
        if (!empty($request->get('term')) && !empty($request->get('city_code'))) {
            return response()->json(Kladr::street($request->get('term'), $request->get('city_code')));
        }
    }

    public function city_and_street(Request $request) {
        if (!empty($request->get('term'))) {
            $limit = 4;

            $city_codes = null;
            if (strpos($request->get('term'), ',') !== false) {
                $term = explode(',', $request->get('term'));
                $city_term = trim(head($term));
                $street_term = last($term);
                $street_term = explode('.', $street_term, 2);
                $street_term = trim(last($street_term));

                $city = Kladr::city($city_term, $this->default_region, $limit);
                $city_codes = substr($city[0]->CITY_CODE, 0, 11);
            } else {
                $city_term = $request->get('term');
                $street_term = $request->get('term');
                $street_term = explode('.', $street_term, 2);
                $street_term = trim(last($street_term));

                $city = Kladr::city($city_term, $this->default_region, $limit);
            }

            $street = Kladr::street($street_term, $city_codes, 91, $limit, true);

            $result = [];

            foreach ($street as $item) {
                $result[] = [
                    'value' => $item->CITY_NAME . ', ' . ($item->STREET_SOCR ? $item->STREET_SOCR . '. ' : '') . $item->STREET_NAME,
                    'data' => [
                        'street_kladr' => $item->STREET_CODE,
                        'city_kladr' => $item->CITY_CODE,
                        'cat' => 'адреса'
                    ]
                ];
            }

            foreach ($city as $item) {
                $result[] = [
                    'value' => $item->CITY_NAME,
                    'data' => [
                        'city_kladr' => $item->CITY_CODE,
                        'cat' => 'город'
                    ]
                ];
            }

            $result = ['suggestions' => $result];

            return response()->json($result);
        }
    }

}
