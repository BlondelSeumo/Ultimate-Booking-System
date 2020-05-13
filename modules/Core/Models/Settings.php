<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Schema;

class Settings extends BaseModel
{
    protected $table = 'core_settings';

    public static function getSettings($group = '')
    {

        if ($group) {
            static::where('group', $group);
        }
        $all = static::all();
        $res = [];
        foreach ($all as $row) {
            $res[$row->name] = $row->val;
        }
        return $res;
    }

    public static function item($item, $default = false)
    {
        $value = Cache::rememberForever('setting_' . $item, function () use ($item ,$default) {
            $val = Settings::where('name', $item)->first();
            return ($val and $val['val'] != null) ? $val['val'] : $default;
        });
        return $value;
    }

    public static function store($key,$data){

        $check = Settings::where('name', $key)->first();
        if($check){
            $check->val = $data;
            $check->save();
        }else{
            $check = new self();
            $check->val = $data;
            $check->name = $key;
            $check->save();
        }

        Cache::forget('setting_' . $key);
    }

    public static function getSettingPages(){
        $all = [
            [
                'id'=>'general',
                'title' => __("General Settings"),
                'position'=>10
            ],
            [
                'id'   => 'style',
                'title' => __("Style Settings"),
                'position'=>70
            ],
            [
                'id'   => 'advance',
                'title' => __("Advance Settings"),
                'position'=>80
            ],
        ];
        $all = array_merge($all,\Modules\Tour\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\User\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\News\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\Booking\SettingClass::getSettingPages());

        // Get All Plugins Menu
        $plugins = \Nwidart\Modules\Facades\Module::allEnabled();
        foreach ($plugins as $plugin){
            $setting_class = config($plugin->getLowerName().'.setting_class');
            if(class_exists($setting_class) and method_exists($setting_class,'getSettingPages'))
            {
                $all = array_merge($all,call_user_func([$setting_class,'getSettingPages']));
            }
        }

        //@todo Sort items by Position
        $all = array_values(\Illuminate\Support\Arr::sort($all, function ($value) {
            return $value['position'] ?? 0;
        }));

        if(!empty($all)){
            foreach ($all as &$item)
            {
                $item['url'] = 'admin/module/core/settings/index/'.$item['id'];
                $item['name'] = $item['title'] ?? $item['id'];
                $item['icon'] = $item['icon'] ?? '';
            }
        }
        return $all;
    }
}
