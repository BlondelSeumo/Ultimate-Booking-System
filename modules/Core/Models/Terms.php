<?php
namespace Modules\Core\Models;

use App\BaseModel;

class Terms extends BaseModel
{
    protected $table = 'bravo_terms';
    protected $fillable = [
        'name',
        'content'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';
}