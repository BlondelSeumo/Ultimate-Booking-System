<?php
namespace Modules\Media\Models;

use App\BaseModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFile extends BaseModel
{
    use SoftDeletes;
    protected $table = 'media_files';

    public static function findMediaByName($name)
    {
        return MediaFile::where("file_name", $name)->firstOrFail();
    }

    public function cacheKey()
    {
        return sprintf("%s/%s", $this->getTable(), $this->getKey());
    }
}