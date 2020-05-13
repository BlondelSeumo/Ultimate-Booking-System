<?php
namespace Modules\Page\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Modules\AdminController;
use Modules\Page\Models\Page;

class PageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            'rows' => Page::paginatte(20)
        ];
        return view('Page::frontend.index', $data);
    }

    public function detail($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (empty($page)) {
            abort(404);
        }
        $data = [
            'row' => $page,
            'seo_meta'  => $page->getSeoMeta(),
        ];
        return view('Page::frontend.detail', $data);
    }
}