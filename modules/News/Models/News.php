<?php
namespace Modules\News\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class News extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_news';
    protected $fillable = [
        'title',
        'content',
        'status',
        'slug',
        'cat_id',
        'image_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';

    public function getDetailUrlAttribute()
    {
        return url('news-' . $this->slug);
    }

    public function geCategorylink()
    {
        return url('news/category/' . $this->slug);
    }

    public function cat()
    {
        return $this->belongsTo('Modules\News\Models\NewsCategory');
    }

    public static function getAll()
    {
        return self::with('cat')->get();
    }

    public function getDetailUrl()
    {
        return url(config('news.news_route_prefix') . "/" . $this->slug);
    }

    public function getCategory()
    {
        $catename = $this->belongsTo("Modules\News\Models\NewsCategory", "cat_id", "id");
        return $catename;
    }

    public function getTags()
    {
        $tags = NewsTag::where('news_id', $this->id)->get();
        $tag_ids = [];
        if (!empty($tags)) {
            foreach ($tags as $key => $value) {
                $tag_ids[] = $value->tag_id;
            }
        }
        return Tag::whereIn('id', $tag_ids)->get();
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

    public function saveTag($tags_name, $tag_ids)
    {

        if (empty($tag_ids))
            $tag_ids = [];
        $tag_ids = array_merge(Tag::saveTagByName($tags_name), $tag_ids);
        $tag_ids = array_filter(array_unique($tag_ids));
        // Delete unused
        NewsTag::whereNotIn('tag_id', $tag_ids)->where('news_id', $this->id)->delete();
        //Add
        NewsTag::addTag($tag_ids, $this->id);
    }

    public function saveSEO(\Illuminate\Http\Request $request)
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'news')->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = "news";
        }
        $meta->fill($request->input());
        return $meta->save();
    }

    public function getSeoMeta()
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'news')->first();
        if (!empty($meta)) {
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = $this->getDetailUrl();
        $meta['service_title'] = $this->title;
        $meta['service_image'] = $this->image_id;
        return $meta;
    }

    static public function getSeoMetaForPageList()
    {
        $meta['seo_title'] = setting_item("news_page_list_seo_title", null) ?? setting_item("news_page_list_title", null) ?? __("News");
        $meta['seo_desc'] = setting_item("news_page_list_seo_desc");
        $meta['seo_image'] = setting_item("news_page_list_seo_image", null) ?? setting_item("news_page_list_banner", null);
        $meta['seo_share'] = setting_item("news_page_list_seo_share");
        $meta['full_url'] = url(config('news.news_route_prefix'));
        return $meta;
    }
}
