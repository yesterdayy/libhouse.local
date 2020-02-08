<?php

namespace App\Http\Middleware;

use App\Models\Realty\Realty;
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
        $request = Realty::filter_middleware($request);

        return $next($request);
    }
}
