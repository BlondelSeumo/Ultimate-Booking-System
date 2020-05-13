<?php
namespace Modules\Core\Models;

use App\BaseModel;

class Menu extends BaseModel
{
    protected $table = 'core_menus';
    protected static $currentMenuItem = false;
    public $lastIndex = 0;

    public function getItemsJsonAttribute()
    {
        $items = json_decode($this->items, true);
        return $this->filterMenuItems($items,$this->lastIndex);
    }

    protected function filterMenuItems($items,&$i = 0){
        $res = [];
        if (!empty($items)) {
            foreach ($items as $k => $item) {
                $item['_id'] = $i;
                $class = $item['item_model'] ?? 'custom';
                $item['model_name'] = '';
                $item['open'] = false;
                if ($class == 'custom') {
                    $item['model_name'] = __('Custom');
                }
                if (method_exists($class, 'getAsMenuItem') and !empty($item['id'])) {
                    $origin = call_user_func([
                        $class,
                        'getAsMenuItem'
                    ], $item['id']);
                    if (!empty($origin)) {
                        $item['origin_name'] = $origin->name;
                        $item['origin_edit_url'] = $origin->edit_url;
                    } else {
                        $item['is_removed'] = true;
                    }
                } else {
                    $item['is_removed'] = true;
                }
                if (method_exists($class, 'getModelName')) {
                    $item['model_name'] = call_user_func([
                        $class,
                        'getModelName'
                    ]);
                }
                if(!empty($item['children'])){
                    $item['children'] = $this->filterMenuItems($item['children'],$i);
                }

                unset($item['_id']);
                if(isset($item['open'])) unset($item['open']);
                if(!isset($item['_open'])) $item['_open'] = false;
                $res[] = $item;
                $i++;
            }
        }
        return $res;
    }
}