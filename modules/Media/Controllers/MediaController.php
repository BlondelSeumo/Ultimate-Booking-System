<?php
namespace Modules\Media\Controllers;

use App\Http\Controllers\Controller;
use Modules\Media\Helpers\FileHelper;

class MediaController extends Controller
{
    public function preview($id, $size = 'thumb')
    {
        return redirect(FileHelper::url($id, $size));
    }
}