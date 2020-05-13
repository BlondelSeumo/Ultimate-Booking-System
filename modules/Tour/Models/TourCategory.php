<?php
namespace Modules\Tour\Models;

use App\BaseModel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourCategory extends BaseModel
{
    use SoftDeletes;
    use NodeTrait;
    protected $table = 'bravo_tour_category';
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
        return __("Tour Category");
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
}