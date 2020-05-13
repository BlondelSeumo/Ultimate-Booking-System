<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2019
 * Time: 9:37 AM
 */
namespace Plugins\Space;

use Modules\Core\Abstracts\BaseSettingsClass;

class SpaceSettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'position'=>30,
                'id'=>'space',
                'title'=>__("Space Settings"),
                'view'=>"space::admin.settings.space",
                "keys"=>[

                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}