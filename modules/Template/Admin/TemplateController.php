<?php
namespace Modules\Template\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Template\Models\Template;

class TemplateController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->checkPermission('template_view');
        $this->setActiveMenu('admin/module/template');
        $data = [
            'rows'       => Template::paginate(20),
            'page_title' => __('Template Management')
        ];
        return view('Template::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->setActiveMenu('admin/module/template');
        $this->checkPermission('template_create');
        $row = new Template();
        $data = [
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Templates'),
                    'url'  => 'admin/module/template'
                ],
                [
                    'name'  => __('Create new template'),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __('Create new Template')
        ];
        return view('Template::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('template_update');
        $this->setActiveMenu('admin/module/template');
        $row = Template::find($id);
        if (empty($row)) {
            return redirect('admin/module/template');
        }
        $data = [
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Templates'),
                    'url'  => 'admin/module/template'
                ],
                [
                    'name'  => __('Edit Template: :title', ['title' => $row->title]),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __('Edit Template: :title', ['title' => $row->title])
        ];
        return view('Template::admin.detail', $data);
    }

    public function getBlocks()
    {
        $template = new Template();
        $this->sendSuccess(['data' => $template->getBlocks()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'title'   => 'required|max:255'
        ]);
        if ($request->input('id')) {
            $this->checkPermission('template_update');
            $template = Template::find($request->input('id'));
        } else {
            $this->checkPermission('template_create');
            $template = new Template();
        }
        if (empty($template))
            $this->sendError('Template not found');
        $template->content = $request->input('content');
        $template->title = $request->input('title');
        $template->save();
        $this->sendSuccess([
            'url' => $request->input('id') ? '' : url('admin/module/template/edit/' . $template->id)
        ], __('Your template has been saved'));
    }
}