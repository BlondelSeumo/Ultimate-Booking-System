<?php
namespace Modules\Review\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Review\Models\Review;

class ReviewController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/review');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission("review_manage_others");
        $model = Review::query();
        $model->orderBy('id', 'desc');
        if (!empty($author = $request->input('customer_id'))) {
            $model->where('create_user', $author);
        }
        if (!empty($search_name = $request->input('s'))) {
            $model->whereRaw(" ( title LIKE '%{$search_name}%' OR author_ip LIKE '%{$search_name}%' OR content LIKE '%{$search_name}%' ) ");
            $model->orderBy('title', 'asc');
        }
        if (!empty($status = $request->input('status'))) {
            $model->where('status', $status);
        }
        if (!empty($service_type = $request->input('service'))) {
            $model->where('object_model', $service_type);
        }
        if (!empty($service_id = $request->input('service_id'))) {
            $model->where('object_id', $service_id);
        }
        $data = [
            'rows'        => $model->paginate(10),
            'breadcrumbs' => [
                ['name'  => __('Review'),
                 'class' => 'active'
                ],
            ]
        ];
        return view('Review::admin.index', $data);
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission("review_manage_others");
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $review = Review::where('id', $id)->first();
                $review->delete();
                $review->save();
            }
        } else {
            foreach ($ids as $id) {
                $review = Review::where('id', $id)->first();
                $review->status = $action;
                $review->save();
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
