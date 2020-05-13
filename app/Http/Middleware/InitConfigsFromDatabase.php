<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/10/2019
 * Time: 9:25 AM
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class InitConfigsFromDatabase
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
        if(strpos($request->path(),'install') === false  && file_exists(storage_path().'/installed')){

            // Load Config from Database
            if(!empty(setting_item('email_from_address'))){
                Config::set('mail.from.address',setting_item("email_from_address"));
            }
            if(!empty(setting_item('email_from_name'))){
                Config::set('mail.from.name',setting_item("email_from_name"));
            }
        }
        return $next($request);
    }
}
