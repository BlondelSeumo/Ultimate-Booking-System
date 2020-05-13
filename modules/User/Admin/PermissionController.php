<?php
namespace Modules\User\Admin;

use App\User;
use Illuminate\Http\Request;
use Modules\AdminController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->checkPermission('permission_view');
        $data = [
            'rows' => Permission::paginate(20)
        ];
        return view('User::admin.permission.index', $data);
    }

    public function create(Request $request)
    {
        if (!empty($request->input())) {
            $row = new Permission($request->input());
            if ($row->save()) {

                return redirect('admin/module/user/permission')->with('success', __('Permission created'));
            }
        } else {
            $row = new Permission();
            $row->fill([
                'status' => 'publish'
            ]);
        }
        $data = [
            'row' => $row
        ];
        return view('User::admin.permission.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('permission_update');
        $row = Permission::find($id);
        if (empty($row)) {
            return redirect('admin/module/user/permission');
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {

                return redirect('admin/module/user/permission')->with('success', __('Permission updated'));
            }
        }
        $data = [
            'row' => $row
        ];
        return view('User::admin.permission.detail', $data);
    }
}