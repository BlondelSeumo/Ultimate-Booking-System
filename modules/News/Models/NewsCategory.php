<?php
namespace Modules\News\Models;

use App\BaseModel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class NewsCategory extends BaseModel
{
    use SoftDeletes;
    use NodeTrait;
    protected $table = 'core_news_category';
    protected $fillable = [
        'name',
        'content',
        'status',
        'parent_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    public static function getModelName()
    {
        return __("News Category");
    }

    public function filterbyCat($id)
    {
        $posts = News::where('news_id', $this->id)->get();
        return $posts;
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if (strlen($q)) {

            $query->where('title', 'name', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }
    public function getDetailUrl()
    {
        return url("/".config('news.news_route_prefix')."/".config('news.news_category_route_prefix')."/".$this->slug);
    }

    public function saveSEO(\Illuminate\Http\Request $request)
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'news_category')->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = "news_category";
        }
        $meta->fill($request->input());
        return $meta->save();
    }

    public function getSeoMeta()
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'news_category')->first();
        if(!empty($meta)){
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = $this->getDetailUrl();
        $meta['service_title'] = $this->name;
        return $meta;
    }
}