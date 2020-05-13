<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2019
 * Time: 10:26 AM
 */
namespace  Modules\Tour;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'tour',
                'title' => __("Tour Settings"),
                'position'=>20,
                'view'=>"Tour::admin.settings.tour",
                "keys"=>[
                    'tour_page_search_title',
                    'tour_page_search_banner',
                    'tour_layout_search',
                    'tour_enable_review',
                    'tour_review_approved',
                    'tour_enable_review_after_booking',
                    'tour_review_number_per_page',
                    'tour_review_stats',
                    'tour_page_list_seo_title',
                    'tour_page_list_seo_desc',
                    'tour_page_list_seo_image',
                    'tour_page_list_seo_share',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}