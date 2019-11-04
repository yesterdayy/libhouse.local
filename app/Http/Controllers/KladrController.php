<?php

namespace App\Http\Controllers;

use App\Models\Kladr\Kladr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KladrController extends Controller
{

    private $default_region = '91';

    public function city(Request $request) {
        if (!empty($request->get('term'))) {
            $result = Kladr::city($request->get('term'), $this->default_region, null, false);
            if ($request->has('noid')) {
                foreach ($result['results'] as $k => $res) {
                    $result['results'][$k]['id'] = $res['text'];
                }
            }
            return response()->json($result);
        }
    }

    public function street(Request $request) {
        if (!empty($request->get('term')) && !empty($request->get('city_code'))) {
            return response()->json(Kladr::street($request->get('term'), $request->get('city_code')));
        }
    }

    public function street_with_city(Request $request) {
        $result = [];

        if (!empty($request->get('term'))) {
            $limit = 4;
            $city_term = null;

            $city_codes = null;
            if (strpos($request->get('term'), ',') !== false && !empty($request->get('city'))) {
                $term = explode(',', $request->get('term'));
                $term = last($term);
                $term = explode('.', $term, 2);
                $term = trim(last($term));
                $data = Kladr::street_alternative($term, $request->get('city'), [91, 92], $limit, true)['results'];

                foreach ($data as $item) {
                    $result[] = [
                        'value' => $item['text'],
                        'data' => [
                            'city_kladr' => $request->get('city'),
                            'street_kladr' => $item['id'],
                        ]
                    ];
                }
            } else {
                $data = Kladr::city($request->get('term'), 91, $limit, false)['results'];

                foreach ($data as $item) {
                    $result[] = [
                        'value' => $item['text'],
                        'data' => [
                            'city_kladr' => $item['id'],
                        ]
                    ];
                }
            }

            $result = ['suggestions' => $result];
        }

        return response()->json($result);
    }

    public function city_and_street(Request $request) {
        if (!empty($request->get('term'))) {
            $limit = 4;
            $city_term = null;

            $city_codes = null;
            if (strpos($request->get('term'), ',') !== false) {
                $terms = explode(',', $request->get('term'));
                $request->merge(['term' => trim($terms[1])]);
                $city_term = trim($terms[1]);
                $city_codes = Kladr::city($request->get('term'), $this->default_region, 1000)['results'];
                $city_codes = array_column($city_codes, 'id');
                $request->merge(['term' => trim($terms[0])]);
            }

            $result = [
                'city' => Kladr::city($request->get('term'), $this->default_region, $limit)['results'],
                'street' => Kladr::street($request->get('term'), $city_codes, [91, 92], $limit, true)['results']
            ];

            if ($request->has('bold')) {
                foreach ($result['city'] as $k => $item) {
                    $result['city'][$k]['text'] = str_replace($request->get('term'), '<b>'.$request->get('term').'</b>', $item['text']);
                    if ($city_term) {
                        $result['city'][$k]['text'] = str_replace($city_term, '<b>' . $city_term . '</b>', $result['city'][$k]['text']);
                    }
                }

                foreach ($result['street'] as $k => $item) {
                    $result['street'][$k]['text'] = str_replace($request->get('term'), '<b>'.$request->get('term').'</b>', $item['text']);
                    if ($city_term) {
                        $result['street'][$k]['text'] = str_replace($city_term, '<b>'.$city_term.'</b>', $result['street'][$k]['text']);
                    }
                }
            }

            if ($request->has('view')) {
                switch ($request['view']) {
                    case 'li':
                        if (!empty($result['city'])) {
                            $city_html = [];
                            foreach ($result['city'] as $item) {
                                $city_html[] = "<li data-val='{$item['id']}'>{$item['text']}</li>";
                            }
                            $result['city'] = implode(' ', $city_html);
                        } else {
                            $result['city'] = '<li>ничего не найдено</li>';
                        }

                        if (!empty($result['street'])) {
                            $street_html = [];
                            foreach ($result['street'] as $item) {
                                $street_html[] = "<li data-val='{$item['id']}'>{$item['text']}</li>";
                            }
                            $result['street'] = implode(' ', $street_html);
                        } else {
                            $result['street'] = '<li>ничего не найдено</li>';
                        }
                        break;
                }
            }

            return response()->json($result);
        }
    }

}
