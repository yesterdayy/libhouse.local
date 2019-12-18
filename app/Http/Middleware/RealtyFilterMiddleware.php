<?php

namespace App\Http\Middleware;

use Closure;

class RealtyFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request['start'] = clear_string($request['start']);
        $request['length'] = clear_string($request['length']);

        $request['term'] = clear_string($request['term']);
        $request['address'] = clear_string($request['address']);
        $request['header_address_city'] = clear_numeric($request['header_address_city']);
        $request['header_address_street'] = clear_numeric($request['header_address_street']);
        $request['trade_type'] = clear_numeric($request['trade_type']);
        $request['dop_type'] = clear_numeric($request['dop_type']);
        $request['price_start'] = clear_numeric($request['price_start']);
        $request['price_end'] = clear_numeric($request['price_end']);

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

        $request['sort'] = clear_string($request['sort']);
        if (!$request['sort']) {
            $request['sort'] = 'default';
        }

        return $next($request);
    }
}
