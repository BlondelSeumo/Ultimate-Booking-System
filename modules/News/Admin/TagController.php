<?php
namespace Modules\News\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\News\Models\Tag;
use Illuminate\Support\Str;

class TagController extends AdminController
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
            $row = new Tag($request->input());
            if (Tag::where('name', $request->input('name'))->exists()) {
                return redirect('admin/module/news/tag')->with('error', __('Tag Existed!'));
            } else {
                if ($row->save()) {
                    $row->saveSEO($request);
                    return redirect('admin/module/news/tag')->with('success', __('Tag created!'));
                }
            }
        }
        $tagname = $request->query('s');
        $taglist = Tag::query() ;
        if ($tagname) {
            $taglist->where('name', 'LIKE', '%' . $tagname . '%');
        }
        $taglist->orderby('name', 'asc');
        $data = [
            'rows'        => $taglist->paginate(20),
            'row'    => new Tag(),
            'breadcrumbs' => [
                [
                    'name' => __('News'),
                    'url'  => 'admin/module/news'
                ],
                [
                    'name'  => __('Tag'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('News::admin.tag.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('news_manage_others');
        $row = Tag::find($id);
        if (empty($row)) {
            return redirect('admin/module/news/tag');
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {
                $row->saveSEO($request);
                return redirect('admin/module/news/tag')->with('success', __('Tag updated'));
            }
        }
        $data = [
            'row'     => $row,
            'parents' => Tag::get()
        ];
        return view('News::admin.tag.detail', $data);
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
                Tag::where("id", $id)->first()->delete();
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
