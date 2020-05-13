<?php
namespace Modules\Hotel\Controllers;

use Illuminate\Http\Request;
use Modules\AdminController;

class HotelController extends AdminController
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('Hotel::index');
    }
}