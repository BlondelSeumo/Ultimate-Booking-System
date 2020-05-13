<?php
namespace App\Helpers;
class MapEngine
{
    public static function scripts()
    {
        $html = '';
        switch (setting_item('map_provider')) {
            case "gmap":
                $html .= sprintf("<script src='https://maps.googleapis.com/maps/api/js?key=%s'></script>", setting_item('map_gmap_key'));
                $html .= sprintf("<script src='%s'></script>", url('libs/infobox.js'));
                break;
        }
        $html .= sprintf("<script src='%s'></script>", url('module/core/js/map-engine.js'));
        return $html;
    }
}