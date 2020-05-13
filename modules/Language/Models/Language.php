<?php
namespace Modules\Language\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_languages';
    protected $fillable = [
        'locale',
        'name',
        'active',
        'flag',
        'status',
    ];

    public function getTranslatedNumberAttribute()
    {
        $count = Translation::where('locale', $this->locale)->whereRaw(" IFNULL(string,'') != '' ")->count();
        return $count;
    }

    public static function getActive()
    {
        return parent::where('status', 'publish')->get();
    }
}