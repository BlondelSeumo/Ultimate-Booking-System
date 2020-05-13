<?php
namespace Modules\Tour\Models;

use App\BaseModel;

class TourTerm extends BaseModel
{
    protected $table = 'bravo_tour_term';
    protected $fillable = [
        'term_id',
        'tour_id'
    ];
}