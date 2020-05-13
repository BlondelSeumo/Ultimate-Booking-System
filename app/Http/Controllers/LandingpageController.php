<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 6/8/19
 * Time: 23:47
 */
namespace App\Http\Controllers;

class LandingpageController extends Controller{

    public function index(){
        return view('landing.index');
    }
}
