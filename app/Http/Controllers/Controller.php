<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Page\Models\Page;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendError($message,$data = []){

        $data['status'] = 0;

        $this->sendSuccess($data,$message);

    }

    public function sendSuccess($data = [],$message = '')
    {
        if(!isset($data['status'])) $data['status'] = 1;

        $data['message'] = $message;

        response()->json($data)->send();
        die;
    }


    public function setActiveMenu($item)
    {
        set_active_menu($item);
    }

    public function currentUser()
    {
        return Auth::user();
    }

}
