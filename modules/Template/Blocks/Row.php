<?php
namespace Modules\Template\Blocks;
class Row extends BaseBlock
{
    public function __construct()
    {
        $this->setOptions([
            'parent_of'    => ['column'],
            'is_container' => true,
            'component'    => 'RowBlock',
            'settings'     => []
        ]);
    }

    public function getName()
    {
        return __('Section');
    }
}