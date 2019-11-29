<?php

namespace App\Http\Middleware;

use Closure;

class RealtyStoreMiddleware
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
        $request['photos'] = isset($request['photos']) ? $request['photos'] : [];

        return $next($request);
    }
}
