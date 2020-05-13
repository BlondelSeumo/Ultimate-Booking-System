<?php
namespace Modules\Location\Models;

use App\BaseModel;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Media\Helpers\FileHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class Location extends BaseModel
{
    use SoftDeletes;
    use NodeTrait;
    protected $table = 'bravo_locations';
    protected $fillable = [
        'name',
        'content',
        'image_id',
        'map_lat',
        'map_lng',
        'map_zoom',
        'status',
        'parent_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    public static function getModelName()
    {
        return __("Location");
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if (strlen($q)) {

            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public function getImageUrl($size = "medium")
    {
        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }

    public function getDisplayNumberServiceInLocation($service_type)
    {
        $allServices = config('booking.services');
        $module = new $allServices[$service_type];
        return $module->getNumberServiceInLocation($this);
    }

    public function saveSEO(\Illuminate\Http\Request $request)
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'location')->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = "location";
        }
        $meta->fill($request->input());
        return $meta->save();
    }

    public function getSeoMeta()
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'location')->first();
        if(!empty($meta)){
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = $this->getDetailUrl();
        $meta['service_title'] = $this->name;
        return $meta;
    }

    public function getDetailUrl()
    {
        return url(config('location.location_route_prefix')."/".$this->slug);
    }
}