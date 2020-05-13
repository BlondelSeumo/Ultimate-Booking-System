<?php
namespace Modules\Location\Controllers;

use App\Http\Controllers\Controller;
use Modules\Location\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {

    }

    public function detail(Request $request, $slug)
    {
        $row = Location::where('slug', $slug)->where("status", "publish")->first();;
        if (empty($row)) {
            return redirect('/');
        }
        return redirect(route('tour.search')."?location_id=".$row->id);
    }
}
