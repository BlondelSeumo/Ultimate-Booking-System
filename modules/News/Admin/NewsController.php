<?php
namespace Modules\News\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\News;

class NewsController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/news');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('news_view');
        $dataNews = new News;
        $post_name = $request->query('s');
        $cate = $request->query('cate_id');
        if ($cate) {
            $dataNews = $dataNews->where('cat_id', $cate);
        }
        if ($post_name) {
            $dataNews = $dataNews->where('title', 'LIKE', '%' . $post_name . '%');
        }
        $dataNews = $dataNews->orderBy('title', 'asc');
        $data = [
            'rows'        => $dataNews->paginate(20),
            'categories'  => NewsCategory::get(),
            'breadcrumbs' => [
                [
                    'name' => __('News'),
                    'url'  => 'admin/module/news'
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('News::admin.news.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('news_create');
        if (!empty($request->input())) {
            $row = new News($request->input());
            if ($row->save()) {
                $row->saveTag($request->input('tag_name'), $request->input('tag_ids'));
                $row->saveSEO($request);
                return redirect('admin/module/news/create')->with('success', __('News Added'));
            }
        }
        $data = [
            'rows'        => NewsCategory::get()->toTree(),
            'row'         => new News(),
            'breadcrumbs' => [
                [
                    'name' => __('News'),
                    'url'  => 'admin/module/news'
                ],
                [
                    'name'  => __('Add News'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('News::admin.news.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('news_update');
        $row = News::find($id);
        if (empty($row)) {
            return redirect('admin/module/news');
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {
                $row->saveTag($request->input('tag_name'), $request->input('tag_ids'));
                $row->saveSEO($request);
                return redirect('admin/module/news/edit/' . $id)->with('success', __("News updated"));
            }
        }
        $data = [
            'row'  => $row,
            'rows' => NewsCategory::get()->toTree(),
            'tags' => $row->getTags()
        ];
        return view('News::admin.news.detail', $data);
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('news_update');
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
                $query = News::where("id", $id);
                if (!$this->hasPermission('news_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('news_delete');
                }
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = News::where("id", $id);
                if (!$this->hasPermission('news_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('news_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
