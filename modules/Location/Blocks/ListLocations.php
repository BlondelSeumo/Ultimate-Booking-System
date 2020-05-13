<?php
namespace Modules\Location\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;

class ListLocations extends BaseBlock
{
    function __construct()
    {
        $list_service = [];
        foreach (config("booking.services") as $key => $service) {
            $list_service[] = ['id'   => $key,
                               'name' => ucwords($key)
            ];
        }
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'service_type',
                    'type'          => 'select',
                    'label'         => "<strong>".__('Service Type')."</strong>",
                    'values'        => $list_service,
                    'selectOptions' => [
                        'noneSelectedText' => __('-- Select --')
                    ]
                ],
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
                    'id'            => 'order',
                    'type'          => 'select',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'id'   => 'id',
                            'name' => __("Date Create")
                        ],
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
        return __('List Locations');
    }

    public function content($model = [])
    {
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if (empty($model['service_type']))
            return '';
        $model_location = Location::query();
        $model_location->where("status","publish");
        $model_location->orderBy($model['order'], $model['order_by']);
        $list = $model_location->limit($model['number'])->get();
        $data = [
            'rows'         => $list,
            'title'        => $model['title'],
            'service_type' => $model['service_type'],
        ];
        return view('Location::frontend.blocks.list-locations.index', $data);
    }
}