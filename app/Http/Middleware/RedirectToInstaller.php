<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectToInstaller
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
        if (strpos($request->path(),'install') === false && !file_exists(storage_path().'/installed')) {

            return redirect('/install');
        }

        if(strpos($request->path(),'install') !== false ){
            if(!file_exists(base_path('.env')))
            {
                // copy file .env.example to .env
                copy(base_path('.env.example'),base_path('.env'));
            }
        }

        return $next($request);
    }
}