<?php
namespace Modules\Core\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsController extends AdminController
{
    protected $groups = [];

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/core/settings/index/general');
    }

    public function index($group)
    {

        if(empty($this->groups)){
            $this->setGroups();
        }

        $this->checkPermission('setting_update');
        $settingsGroupKeys = array_keys($this->groups);
        if (empty($group) or !in_array($group, $settingsGroupKeys)) {
            $group = $settingsGroupKeys[0];
        }
        $data = [
            'current_group' => $group,
            'groups'        => $this->groups,
            'settings'      => Settings::getSettings($group),
            'breadcrumbs'   => [
                ['name' => $this->groups[$group]['name'] ?? $this->groups[$group]['title'] ?? ''],
            ],
            'page_title'    => $this->groups[$group]['name'] ?? $this->groups[$group]['title'] ?? $group,
            'group'         => $this->groups[$group]
        ];
        return view('Core::admin.settings.index', $data);
    }

    public function store(Request $request, $group)
    {

        if(empty($this->groups)){
            $this->setGroups();
        }

        $this->checkPermission('setting_update');
        $settingsGroupKeys = array_keys($this->groups);
        if (empty($group) or !in_array($group, $settingsGroupKeys)) {
            $group = $settingsGroupKeys[0];
        }
        $group_data = $this->groups[$group];
        $keys = [];
        $htmlKeys = [];
        switch ($group) {
            case 'general':
                $keys = [
                    'site_title',
                    'site_desc',
                    'admin_email',
                    'email_from_name',
                    'email_from_address',
                    'home_page_id',
                    'social_share',
                    'logo_id',
                    'footer_text_left',
                    'footer_text_right',
                    'list_widget_footer',
                    'date_format',
                    'site_locale'
                ];
                break;
            case 'style':
                $keys = [
                    'style_main_color',
                    'style_custom_css',
                    'style_typo'
                ];
                break;
            case 'advance':
                $keys = [
                    'map_provider',
                    'map_gmap_key',
                    'google_client_secret',
                    'google_client_id',
                    'google_enable',
                    'facebook_client_secret',
                    'facebook_client_id',
                    'facebook_enable',
                    'twitter_enable',
                    'twitter_client_id',
                    'twitter_client_secret',
                    'recaptcha_enable',
                    'recaptcha_api_key',
                    'recaptcha_api_secret',
                    'body_scripts',
                    'footer_scripts',
                ];
                break;
        }

        if(!empty($group_data['keys'])) $keys = $group_data['keys'];
        if(!empty($group_data['html_keys'])) $htmlKeys = $group_data['html_keys'];

        if (!empty($request->input())) {
            if (!empty($keys)) {
                foreach ($keys as $key) {
                    $check = Settings::where('name', $key)->first();
                    if (!$check) {
                        $a = new Settings();
                        $a->name = $key;
                        $a->val = $request->input($key);
                        $a->group = $group;
                        if (is_array($a->val)) {
                            $a->val = json_encode($a->val);
                        }
                        if (in_array($key, $htmlKeys)) {
                            $a->val = clean($a->val);
                        }
                        $a->save();
                    } else {
                        $check->val = $request->input($key);
                        if (is_array($check->val)) {
                            $check->val = json_encode($check->val);
                        }
                        if (in_array($key, $htmlKeys)) {
                            $check->val = clean($check->val);
                        }
                        $check->save();
                    }
                    Cache::forget('setting_' . $key);
                }
            }
            return redirect()->back()->with('success', __('Settings Saved'));
        }
    }


    protected function setGroups(){

        $all = Settings::getSettingPages();

        $res = [];

        if(!empty($all))
        {
            foreach ($all as $item){
                $res[$item['id']] = $item;
            }
        }
        $this->groups = $res;
    }
}
