<?php
namespace Modules\Core\Models;

use App\BaseModel;

class Attributes extends BaseModel
{
    protected $table = 'bravo_attrs';
    protected $fillable = ['name'];
    protected $slugField = 'slug';
    protected $slugFromField = 'name';

    public function terms()
    {
        return $this->hasMany(Terms::class, 'attr_id', 'id');
    }
}