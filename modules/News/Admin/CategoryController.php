<?php
namespace Modules\News\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\News\Models\NewsCategory;
use Illuminate\Support\Str;

class CategoryController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/news');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('news_manage_others');
        if (!empty($request->input('name'))) {
            $row = new NewsCategory($request->input());
            if (NewsCategory::where('name', $request->input('name'))->where('parent_id',$request->input('parent_id'))->exists()) {
                return redirect()->back()->with('error', __('Category is Existed !'));
            } else {
                $row->status = 'publish';
                $row->parent_id = $request->input('parent_id');
                if ($row->save()) {
                    $row->saveSEO($request);
                    return redirect('admin/module/news/category')->with('success', __('Category is created!'));
                }
            }
        }
        $catlist = new NewsCategory;
        if ($catename = $request->query('s')) {
            $catlist = $catlist->where('name', 'LIKE', '%' . $catename . '%');
        }
        $catlist = $catlist->orderby('name', 'asc');
        $rows = $catlist->get();

        $data = [
            'rows'        => $rows->toTree(),
            'row'         => new NewsCategory(),
            'breadcrumbs' => [
                [
                    'name' => __('News'),
                    'url'  => 'admin/module/news'
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('News::admin.category.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('news_manage_others');
        $row = NewsCategory::find($id);
        if (empty($row)) {
            return redirect('admin/module/news/category');
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {
                $row->saveSEO($request);
                return redirect('admin/module/news/category')->with('success', __('Category updated'));
            }
        }
        $data = [
            'row'     => $row,
            'parents' => NewsCategory::get()->toTree()
        ];
        return view('News::admin.category.detail', $data);
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('news_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an Action!'));
        }
        if ($action == 'delete') {
            foreach ($ids as $id) {
                NewsCategory::where("id", $id)->first()->delete();
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
