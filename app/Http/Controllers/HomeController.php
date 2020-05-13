<?php
namespace App\Http\Controllers;

use Modules\Core\Models\Settings;
use Modules\Page\Models\Page;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\News\Models\News;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_page_id = setting_item('home_page_id');
        if($home_page_id && $page = Page::where("id",$home_page_id)->where("status","publish")->first())
        {
            $this->setActiveMenu($page);
            $seo_meta = $page->getSeoMeta();
            $seo_meta['full_url'] = url("/");
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta
            ];
            return view('Page::frontend.detail',$data);
        }
        $model_News = News::where("status", "publish");
        $data = [
            'rows'=>$model_News->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news") ,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index',$data);
    }

    public function test()
    {
        var_dump(setting_item('email_header'));
     var_dump(setting_item('site_title'));
     die;
        return view('test');
    }

    /**
     * @todo Update From 1.0 to 1.1
     */
    public function updateTo110(){
        if(setting_item('update_to_110')){
            echo "Updated";
            die;
        }
        // Update to 1.1
        Permission::findOrCreate('dashboard_vendor_access');

        $vendor = Role::findOrCreate('vendor');

        $vendor->givePermissionTo('media_upload');
        $vendor->givePermissionTo('tour_view');
        $vendor->givePermissionTo('tour_create');
        $vendor->givePermissionTo('tour_update');
        $vendor->givePermissionTo('tour_delete');
        $vendor->givePermissionTo('dashboard_vendor_access');

        $role = Role::findOrCreate('administrator');

        $role->givePermissionTo('dashboard_vendor_access');

        Settings::store('update_to_110',true);
        echo "Done";
    }
}
