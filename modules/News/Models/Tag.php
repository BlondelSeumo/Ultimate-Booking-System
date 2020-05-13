<?php
namespace Modules\News\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class Tag extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_tags';
    protected $fillable      = [
        'name',
        'content',
        'slug'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    public static function getModelName()
    {
        return __("New Tag");
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if ($q) {
            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public static function saveTagByName($tag_name)
    {
        $ids = [];
        if (!empty($tag_name)) {
            foreach ($tag_name as $name) {
                $find = parent::where('name', trim($name))->first();
                if (empty($find)) {
                    $tag = new self();
                    $tag->name = $name;
                    $tag->save();
                    $ids[] = $tag->id;
                } else {
                    $ids[] = $find->id;
                }
            }
        }
        return $ids;
    }

    public function saveSEO(\Illuminate\Http\Request $request)
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'news_tag')->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = "news_tag";
        }
        $meta->fill($request->input());
        return $meta->save();
    }

    public function getSeoMeta()
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'news_tag')->first();
        if (!empty($meta)) {
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = $this->getDetailUrl();
        $meta['service_title'] = $this->name;
        return $meta;
    }

    public function getDetailUrl()
    {
        return url("/" . config('news.news_route_prefix') . "/" . config('news.news_tag_route_prefix') . "/".$this->slug);
    }
}
