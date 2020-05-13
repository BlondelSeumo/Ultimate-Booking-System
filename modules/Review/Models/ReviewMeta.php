<?php
namespace Modules\Review\Models;

use Modules\Booking\Models\Bookable;

class ReviewMeta extends Bookable
{
    protected $table    = 'bravo_review_meta';
    protected $fillable = [
        'review_id',
        'object_id',
        'object_model',
        'name',
        'val',
    ];
}