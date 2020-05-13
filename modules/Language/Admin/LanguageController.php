<?php
namespace Modules\Language\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\AdminController;
use Modules\Language\Models\Language;

class LanguageController extends AdminController
{
    public function index(Request $request)
    {
        $this->checkPermission('language_manage');
        if ($request->isMethod('post') and !empty($request->input())) {
            $this->validate($request,[
                'name'=>'required',
                'flag'=>'required',
                'locale'=>'required'
            ]);
            $check = Language::withTrashed()->where('locale', $request->input('locale'))->first();
            if ($check and $check->trashed()) {
                $check->restore();
                $check->fill($request->input());
                $check->save();
            }else{
                $this->validate($request,[
                    'locale'=>'unique:core_languages,locale'
                ]);
                $row = new Language($request->input());
                $row->save();
            }
            return redirect('admin/module/language')->with('success', __("Language created"));
        }
        $listLanguage = Language::query() ;
        if (!empty($search = $request->query('s'))) {
            $listLanguage->where('name', 'LIKE', '%' . $search . '%');
            $listLanguage->Orwhere('locale', 'LIKE', '%' . $search . '%');
        }
        $listLanguage->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $listLanguage->paginate(20),
            'row'         => new Language(),
            'locales'     => config('languages.locales'),
            'breadcrumbs' => [
                [
                    'name'  => __('Language Management'),
                    'class' => 'active'
                ],
            ]
        ];
        $this->setActiveMenu('admin/module/core/tools');
        return view('Language::admin.language.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('language_manage');

        $row = Language::find($id);

        if (empty($row)) {
            return redirect('admin/module/language');
        }


        if (!empty($request->input())) {

            $this->validate($request,[
                'name'=>'required',
                'flag'=>'required',
                'locale'=>[
                    'required',
                    Rule::unique('core_languages')->ignore($row->id)
                ]
            ]);

            $row->fill($request->input());

            if ($row->save()) {
                return redirect()->back()->with('success', __('Language updated'));
            }
        }
        $data = [
            'row'         => $row,
            'locales'     => config('languages.locales'),
            'breadcrumbs' => [
                [
                    'name' => __('Languages'),
                    'url'  => 'admin/module/language'
                ],
                [
                    'name'  => __('Edit: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        $this->setActiveMenu('admin/module/core/tools');
        return view('Language::admin.language.detail', $data);
    }

    public function editBulk(Request $request)
    {
        $this->checkPermission('language_manage');

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __("Select at least 1 item!"));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Language::where("id", $id);
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = Language::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }
}
