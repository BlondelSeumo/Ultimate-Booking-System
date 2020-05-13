<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ChangeLocaleFromSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(strpos($request->path(),'install') === false){
            if ($locale = setting_item('site_locale')) {

                App::setLocale($locale);
            }
        }
        return $next($request);
    }
}
