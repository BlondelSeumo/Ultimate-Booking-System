<?php
namespace Modules\Page\Models;

use App\BaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class Page extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_pages';
    protected $fillable = [
        'title',
        'content',
        'status',
        'short_desc',
        'image_id',
        'slug',
        'template_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    protected $cleanFields = [
        'content',
    ];

    public function getDetailUrl()
    {
        return url(config('page.page_route_prefix')."/".$this->slug);
    }

    public static function getModelName()
    {
        return __("Page");
    }

    public static function getAsMenuItem($id)
    {
        return parent::select('id', 'title as name')->find($id);
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if (strlen($q)) {

            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public function getEditUrlAttribute()
    {
        return url('admin/module/page/edit/' . $this->id);
    }

    public function template()
    {
        return $this->hasOne("\\Modules\\Template\\Models\\Template", 'id', 'template_id');
    }

    public function getProcessedContent()
    {

        return $this->template->getProcessedContent();
    }

    public function saveSEO(\Illuminate\Http\Request $request)
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'page')->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = "page";
        }
        $meta->fill($request->input());
        return $meta->save();
    }

    public function getSeoMeta()
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'page')->first();
        if(!empty($meta)){
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = $this->getDetailUrl();
        $meta['service_title'] = $this->title;
        $meta['service_desc'] = $this->short_desc;
        $meta['service_image'] = $this->image_id;
        return $meta;
    }
}