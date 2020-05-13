<?php
namespace Modules\Tour\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Location\Models\Location;

class ListTours extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'select',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'id'   => 'normal',
                            'name' => __("Normal")
                        ],
                        [
                            'id'   => 'carousel',
                            'name' => __("Slider Carousel")
                        ]
                    ],
                    'selectOptions' => [
                        'noneSelectedText' => __('-- Select --')
                    ]
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Filter by Category'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => url('/admin/module/tour/category/getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%'
                    ],
                    'pre_selected'=>url('/admin/module/tour/category/getForSelect2?pre_selected=1')
                ],
                [
                    'id'      => 'location_id',
                    'type'    => 'select2',
                    'label'   => __('Filter by Location'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => url('/admin/module/location/getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%'
                    ],
                    'pre_selected'=>url('/admin/module/location/getForSelect2?pre_selected=1')
                ],
                [
                    'id'            => 'order',
                    'type'          => 'select',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'id'   => 'id',
                            'name' => __("Date Create")
                        ],
                        /*[
                            'id'   => 'price',
                            'name' => __("Price")
                        ],
                        [
                            'id'   => 'review_score',
                            'name' => __("Review Score")
                        ],*/
                    ],
                    'selectOptions' => [
                        'noneSelectedText' => __('-- Select --')
                    ]
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'select',
                    'label'         => __('Order By'),
                    'values'        => [
                        [
                            'id'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'id'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ],
                    'selectOptions' => [
                        'noneSelectedText' => __('-- Select --')
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('List Tours');
    }

    public function content($model = [])
    {
        $model_Tour = Tour::query();
        if(empty($model['order'])) $model['order'] = "bravo_tours.id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if (!empty($model['location_id'])) {
            $location = Location::where('id', $model['location_id'])->where("status","publish")->first();
            if(!empty($location)){
                $model_Tour->join('bravo_locations', function ($join) use ($location) {
                    $join->on('bravo_locations.id', '=', 'bravo_tours.location_id')
                        ->where('bravo_locations._lft', '>=', $location->_lft)
                        ->where('bravo_locations._rgt', '<=', $location->_rgt);
                });
            }
        }
        if (!empty($model['category_id'])) {
            $category_ids = [$model['category_id']];
            $list_cat = TourCategory::whereIn('id', $category_ids)->where("status","publish")->get();
            if(!empty($list_cat)){
                $where_left_right = [];
                foreach ($list_cat as $cat){
                    $where_left_right[] = " ( bravo_tour_category._lft >= {$cat->_lft} AND bravo_tour_category._rgt <= {$cat->_rgt} ) ";
                }
                $sql_where_join = " ( ".implode("OR" , $where_left_right)." )  ";
                $model_Tour
                    ->join('bravo_tour_category', function ($join) use($sql_where_join) {
                        $join->on('bravo_tour_category.id', '=', 'bravo_tours.category_id')
                            ->WhereRaw($sql_where_join);
                    });
            }
        }
        $model_Tour->orderBy("bravo_tours.".$model['order'], $model['order_by']);
        $model_Tour->where("bravo_tours.status", "publish");
        $model_Tour->with('location');
        $model_Tour->groupBy("bravo_tours.id");
        $list = $model_Tour->limit($model['number'])->get();
        $data = [
            'rows'       => $list,
            'style_list' => $model['style'],
            'title'      => $model['title'],
        ];
        return view('Tour::frontend.blocks.list-tour.index', $data);
    }
}
