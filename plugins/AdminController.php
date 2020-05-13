<?php
namespace Plugins;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function checkPermission($permission = false)
    {
        if ($permission) {
            if (!Auth::user()->hasPermissionTo($permission)) {
                abort(403);
            }
        }
    }

    public function hasPermission($permission)
    {
        return Auth::user()->hasPermissionTo($permission);
    }
}