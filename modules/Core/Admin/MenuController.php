<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\Models\Menu;
use Modules\News\Models\NewsCategory;
use Modules\Page\Models\Template;

class MenuController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/core/menu');
        parent::__construct();
    }

    public function index()
    {

        $this->checkPermission('menu_view');
        $data = [
            'rows'           => Menu::paginate(20),
            'locations'      => $this->getLocations(),
            "menu_locations" => (array)json_decode(setting_item('menu_locations'), true)
        ];
        return view('Core::admin.menu.index', $data);
    }

    public function getLocations()
    {
        return [
            'primary' => __("Primary"),
            'footer'  => __("Footer"),
        ];
    }

    public function create()
    {

        $this->checkPermission('menu_create');
        $data = [
            'row'                    => new Menu(),
            'locations'              => $this->getLocations(),
            'current_menu_locations' => [],
            'breadcrumbs'            => [
                [
                    'name' => __('Menus'),
                    'url'  => 'admin/module/core/menu'
                ],
                [
                    'name'  => __('Create new menu'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Core::admin.menu.detail', $data);
    }

    public function edit($id)
    {

        $this->checkPermission('menu_update');
        $row = Menu::find($id);
        if (empty($row)) {
            abort(404);
        }
        $setting = json_decode(setting_item('menu_locations'), true);
        $current_menu_locations = [];
        if (!empty($setting) and is_array($setting)) {
            foreach ($setting as $location => $item) {
                if ($item == $id) {
                    $current_menu_locations[] = $location;
                }
            }
        }
        $data = [
            'row'                    => $row,
            'locations'              => $this->getLocations(),
            'current_menu_locations' => $current_menu_locations,
            'breadcrumbs'            => [
                [
                    'name' => __('Menus'),
                    'url'  => 'admin/module/core/menu'
                ],
                [
                    'name'  => __('Edit: ') . $row->name,
                    'class' => 'active'
                ],
            ]
        ];

        return view('Core::admin.menu.detail', $data);
    }

    public function searchTypeItems(Request $request)
    {

        $class = $request->input('class');
        $q = $request->input('q');
        if (class_exists($class) and method_exists($class, 'searchForMenu')) {

            $this->sendSuccess([
                'data' => call_user_func([
                    $class,
                    'searchForMenu'
                ], $q)
            ]);
        }
        $this->sendSuccess([
            'data' => []
        ]);
    }

    public function getTypes()
    {
        $menuModels = [
            [
                'class' => \Modules\Page\Models\Page::class,
                'name'  => __("Page"),
                'items' => \Modules\Page\Models\Page::searchForMenu()
            ],
            [
                'class' => \Modules\Tour\Models\Tour::class,
                'name'  => __("Tour"),
                'items' => \Modules\Tour\Models\Tour::searchForMenu()
            ],
            [
                'class' => \Modules\Tour\Models\TourCategory::class,
                'name'  => __("Tour Category"),
                'items' => \Modules\Tour\Models\TourCategory::searchForMenu()
            ],
            [
                'class' => \Modules\Location\Models\Location::class,
                'name'  => __("Location"),
                'items' => \Modules\Location\Models\Location::searchForMenu()
            ],
            [
                'class' => \Modules\News\Models\News::class,
                'name'  => __("News"),
                'items' => \Modules\News\Models\News::searchForMenu()
            ],
            [
                'class' => NewsCategory::class,
                'name'  => __("News Category"),
                'items' => NewsCategory::searchForMenu()
            ],
        ];
        foreach ($menuModels as $k => &$item) {
            $item['q'] = '';
            $item['open'] = !$k ? true : false;
            $item['selected'] = [];
            if (!empty($item['items'])) {
                foreach ($item['items'] as &$menuItem) {
                    $menuItem['class'] = '';
                    $menuItem['target'] = '';
                    $menuItem['open'] = false;
                    $menuItem['item_model'] = $item['class'];
                    $menuItem['origin_name'] = $item['name'];
                    $menuItem['model_name'] = $item['class']::getModelName();
                }
            }
        }
        $this->sendSuccess(['data' => $menuModels]);
    }

    public function getItems(Request $request)
    {

        $menu = Menu::find($request->input('id'));
        if (empty($menu))
            $this->sendError(__("Menu not found"));
        $this->sendSuccess(['data' => json_decode($menu->items, true)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'name'  => 'required|max:255'
        ]);
        if ($request->input('id')) {

            $this->checkPermission('menu_update');
            $menu = Menu::find($request->input('id'));
        } else {

            $this->checkPermission('menu_create');
            $menu = new Menu();
        }
        if (empty($menu))
            $this->sendError(__('Menu not found'));
        $menu->items = $request->input('items');
        $menu->name = $request->input('name');
        $menu->save();
        $setting = json_decode(setting_item('menu_locations'), true);
        $hasChange = false;
        if (!empty($setting)) {
            foreach ($setting as $location => $menuId) {
                if ($menuId == $menu->id) {
                    $setting[$location] = '';
                }
            }
        }
        // Save Locations
        $locations = $request->input('locations');
        if (!empty($locations)) {
            foreach ($locations as $location) {
                if (!isset($setting[$location]))
                    $setting[$location] = [];
                $setting[$location] = $menu->id;
            }
        }
        setting_update_item('menu_locations', json_encode($setting));
        $this->sendSuccess([
            'url' => $request->input('id') ? '' : url('admin/module/core/menu/edit/' . $menu->id)
        ], __('Your menu has been saved'));
    }
}