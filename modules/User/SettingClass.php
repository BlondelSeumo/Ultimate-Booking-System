<?php
namespace  Modules\User;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'user',
                'title' => __("User Settings"),
                'position'=>50,
                'view'=>"User::admin.settings.user",
                "keys"=>[
                    'user_enable_login_recaptcha',
                    'user_enable_register_recaptcha',
                    'enable_mail_user_registered',
                    'user_content_email_registered',
                    'admin_enable_mail_user_registered',
                    'admin_content_email_user_registered',
                    'user_content_email_forget_password',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
