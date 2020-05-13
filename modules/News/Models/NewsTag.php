<?php
namespace Modules\News\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsTag extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_news_tag';
    protected $fillable = [
        'news_id',
        'tag_id'
    ];

    public static function getModelName()
    {
        return __("News Tag");
    }

    public static function searchForMenu($q = false)
    {

    }

    public function tag()
    {
        return $this->belongsTo('Modules\News\Models\NewsTag');
    }

    public static function getAll()
    {
        return self::with('tag')->get();
    }

    public static function addTag($tags_ids, $news_id)
    {
        if (!empty($tags_ids)) {
            foreach ($tags_ids as $tag_id) {
                $find = parent::where('news_id', $news_id)->where('tag_id', $tag_id)->first();
                if (empty($find)) {

                    $a = new self();
                    $a->news_id = $news_id;
                    $a->tag_id = $tag_id;
                    $a->save();
                }
            }
        }
    }
}
