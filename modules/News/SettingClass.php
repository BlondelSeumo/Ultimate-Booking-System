<?php
namespace  Modules\News;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'news',
                'title' => __("News Settings"),
                'position'=>30,
                'view'=>"News::admin.settings.news",
                "keys"=>[
                    'news_page_list_title',
                    'news_page_list_banner',
                    'news_sidebar',
                    'news_page_list_seo_title',
                    'news_page_list_seo_desc',
                    'news_page_list_seo_image',
                    'news_page_list_seo_share',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}