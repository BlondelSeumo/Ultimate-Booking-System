<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
class General extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Setting header,footer
        DB::table('core_menus')->insert([
            'name' => 'Main Menu',
            'items' => '[{"name":"Home","url":"/","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_nN1e4","_treeNodePropertiesCompleted":true,"children":[]},{"name":"Tours","url":"/tour","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_vPxkO","_treeNodePropertiesCompleted":true,"children":[{"name":"Tour List","url":"/tour","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_8TOm3","_treeNodePropertiesCompleted":true,"children":[]},{"name":"Tour Map","url":"/tour?_layout=map","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_9nYm5","_treeNodePropertiesCompleted":true,"children":[]},{"name":"Tour Detail","url":"/tour/paris-vacation-travel","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_PxIl9","_treeNodePropertiesCompleted":true,"children":[]}]},{"name":"News","url":"/news","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_1Crza","_treeNodePropertiesCompleted":true,"children":[{"name":"News List","url":"/news","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_wt60u","_treeNodePropertiesCompleted":true,"children":[]},{"name":"News Detail","url":"/news/morning-in-the-northern-sea","item_model":"custom","model_name":"Custom","is_removed":true,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_QaL0O","_treeNodePropertiesCompleted":true,"children":[]}]},{"name":"Contact","url":"/contact","item_model":"custom","_open":false,"open":true,"active":false,"class":"","innerClass":"","_id":"tree_2_node_enBXq","_treeNodePropertiesCompleted":true,"children":[]}]',
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'menu_locations',
                    'val' => '{"primary":1}',
                    'group' => "general",
                ],
                [
                    'name' => 'admin_email',
                    'val' => 'contact@bookingcore.com',
                    'group' => "general",
                ],[
                    'name' => 'email_from_name',
                    'val' => 'Booking Core',
                    'group' => "general",
                ],[
                    'name' => 'email_from_address',
                    'val' => 'contact@bookingcore.com',
                    'group' => "general",
                ],
                [
                    'name' => 'logo_id',
                    'val' => MediaFile::findMediaByName("logo")->id,
                    'group' => "general",
                ],
                [
                    'name' => 'social_share',
                    'val' => '[{"link":"#","class_icon":"fa fa-facebook"},{"link":"#","class_icon":"fa fa-linkedin"},{"link":"#","class_icon":"fa fa-google-plus"}]',
                    'group' => "general",
                ],
                [
                    'name' => 'footer_text_left',
                    'val' => 'Copyright © 2019 by Booking Core',
                    'group' => "general",
                ],
                [
                    'name' => 'footer_text_right',
                    'val' => 'Booking Core',
                    'group' => "general",
                ],
                [
                    'name' => 'list_widget_footer',
                    'val' => '[{"title":"NEED HELP?","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Call Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Email for Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            hello@yoursite.com\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Follow Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <img src=\"https:\/\/travelhotel.wpengine.com\/wp-content\/uploads\/2018\/12\/ico_facebook_footer.png\">\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <img src=\"https:\/\/travelhotel.wpengine.com\/wp-content\/uploads\/2018\/12\/ico_twitter_footer.png\">\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <img src=\"https:\/\/travelhotel.wpengine.com\/wp-content\/uploads\/2018\/12\/ico_instagram_footer.png\">\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"COMPANY","size":"3","content":"<ul>\r\n    <li><a href=\"#\">About Us<\/a><\/li>\r\n    <li><a href=\"#\">Community Blog<\/a><\/li>\r\n    <li><a href=\"#\">Rewards<\/a><\/li>\r\n    <li><a href=\"#\">Work with Us<\/a><\/li>\r\n    <li><a href=\"#\">Meet the Team<\/a><\/li>\r\n<\/ul>"},{"title":"SUPPORT","size":"3","content":"<ul>\r\n    <li><a href=\"#\">Account<\/a><\/li>\r\n    <li><a href=\"#\">Legal<\/a><\/li>\r\n    <li><a href=\"#\">Contact<\/a><\/li>\r\n    <li><a href=\"#\">Affiliate Program<\/a><\/li>\r\n    <li><a href=\"#\">Privacy Policy<\/a><\/li>\r\n<\/ul>"},{"title":"SETTINGS","size":"3","content":"<ul>\r\n<li><a href=\"#\">Setting 1<\/a><\/li>\r\n<li><a href=\"#\">Setting 2<\/a><\/li>\r\n<\/ul>"}]',
                    'group' => "general",
                ]
            ]
        );

        $banner_image = MediaFile::findMediaByName("banner-search")->id;
        $icon_about_1 = MediaFile::findMediaByName("ico_localguide")->id;
        $icon_about_2 = MediaFile::findMediaByName("ico_adventurous")->id;
        $icon_about_3 = MediaFile::findMediaByName("ico_maps")->id;
        $avatar = MediaFile::findMediaByName("avatar")->id;
        $avatar_2 = MediaFile::findMediaByName("avatar-2")->id;
        $avatar_3 = MediaFile::findMediaByName("avatar-3")->id;
        // Setting Home Page
        DB::table('core_templates')->insert([
            'title' => 'Home',
            'content' => '[{"type":"form_search_tour","name":"Form Search Tours","model":{"title":"Love where you\'re going","sub_title":"Book incredible things to do around the world.","bg_image":'.$banner_image.'},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_featured_item","name":"List Featured Item","model":{"list_item":[{"_active":false,"title":"1,000+ local guides","sub_title":"Morbi semper fames lobortis ac hac penatibus","icon_image":'.$icon_about_1.'},{"_active":false,"title":"Handcrafted experiences","sub_title":"Morbi semper fames lobortis ac hac penatibus","icon_image":'.$icon_about_2.'},{"_active":false,"title":"96% happy travelers","sub_title":"Morbi semper fames lobortis ac hac penatibus","icon_image":'.$icon_about_3.'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_tours","name":"List Tours","model":{"title":"Trending Tours","number":5,"style":"carousel","category_id":"","location_id":"","order":"id","order_by":"desc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_locations","name":"List Locations","model":{"title":"Top Destinations","number":5,"order":"id","order_by":"desc","service_type":"tour"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_tours","name":"List Tours","model":{"title":"Local Experiences You’ll Love","number":8,"style":"normal","category_id":"","location_id":"","order":"id","order_by":"asc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"call_to_action","name":"Call To Action","model":{"title":"Know your city?","sub_title":"Join 2000+ locals & 1200+ contributors from 3000 cities","link_title":"Become Local Expert","link_more":"#"},"component":"RegularBlock","open":true,"is_container":false},{"type":"testimonial","name":"List Testimonial","model":{"title":"Our happy clients","list_item":[{"_active":false,"name":"Eva Hicks","desc":"Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui. ","number_star":5,"avatar":'.$avatar.'},{"_active":false,"name":"Donald Wolf","desc":"Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui. ","number_star":6,"avatar":'.$avatar_2.'},{"_active":false,"name":"Charlie Harrington","desc":"Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.","number_star":5,"avatar":'.$avatar_3.'}]},"component":"RegularBlock","open":true,"is_container":false}]',
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_pages')->insert([
            'title' => 'Home Page',
            'slug' => 'home-page',
            'template_id' => '1',
            'create_user' => '1',
            'status' => 'publish',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_settings')->insert(
            [
                'name' => 'home_page_id',
                'val' => '1',
                'group' => "general",
            ]
        );


        // Setting Currency
        DB::table('core_settings')->insert(
            [
                [
                    'name' => "currency_main",
                    'val' => "usd",
                    'group' => "payment",
                ],
                [
                    'name' => "currency_format",
                    'val' => "left",
                    'group' => "payment",
                ],
                [
                    'name' => "currency_decimal",
                    'val' => ",",
                    'group' => "payment",
                ],
                [
                    'name' => "currency_thousand",
                    'val' => ".",
                    'group' => "payment",
                ],
                [
                    'name' => "currency_no_decimal",
                    'val' => "0",
                    'group' => "payment",
                ]
            ]
        );

        //MAP
        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'map_provider',
                    'val' => 'gmap',
                    'group' => "advance",
                ],
                [
                    'name' => 'map_gmap_key',
                    'val' => '',
                    'group' => "advance",
                ]
            ]
        );

        // Payment Gateways
        DB::table('core_settings')->insert(
            [
                [
                    'name' => "g_offline_payment_enable",
                    'val' => "1",
                    'group' => "payment",
                ],
                [
                    'name' => "g_offline_payment_name",
                    'val' => "Offline Payment",
                    'group' => "payment",
                ]
            ]
        );

        // Settings general
        DB::table('core_settings')->insert(
            [
                [
                    'name' => "date_format",
                    'val' => "m/d/Y",
                    'group' => "general",
                ],
                [
                    'name' => "site_title",
                    'val' => "Booking Core",
                    'group' => "general",
                ],
            ]
        );

        // Email general
        DB::table('core_settings')->insert(
            [
                [
                    'name' => "email_header",
                    'val' => '<h1 class="site-title" style="text-align: center">Booking Core</h1>',
                    'group' => "general",
                ],
                [
                    'name' => "email_footer",
                    'val' => '<p class="" style="text-align: center">&copy; 2019 Booking Core. All rights reserved</p>',
                    'group' => "general",
                ],
            ]
        );
    }
}
