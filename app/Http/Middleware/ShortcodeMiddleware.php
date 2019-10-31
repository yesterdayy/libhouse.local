<?php

namespace App\Http\Middleware;

use App\Components\Shortcodes;
use Closure;

class ShortcodeMiddleware
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
        $response = $next($request);
        if (!method_exists($response, 'content')) {
            return false;
        }

        $content = $response->content();
        $content = Shortcodes::parseShortcodes($content);

        $response->setContent($content);
        return $response;
    }
}
