<?php
namespace Modules\Dashboard\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\AdminController;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return View('Dashboard::index');
    }
}