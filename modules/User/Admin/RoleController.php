<?php
namespace Modules\User\Admin;

use App\User;
use Illuminate\Http\Request;
use Modules\AdminController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->checkPermission('role_view');
        $data = [
            'rows' => Role::paginate(20)
        ];
        return view('User::admin.role.index', $data);
    }

    public function create(Request $request)
    {
        if (!empty($request->input())) {
            $row = new Role($request->input());
            if ($row->save()) {
                return redirect('admin/module/user/role')->with('success', __('Role created'));
            }
        } else {
            $row = new User();
            $row->fill([
                'status' => 'publish'
            ]);
        }
        $data = [
            'row' => $row
        ];
        return view('User::admin.role.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('role_update');
        $row = Role::find($id);
        if (empty($row)) {
            return redirect('admin/module/user/role');
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {

                return redirect('admin/module/user/role')->with('success', __('Role updated'));
            }
        }
        $data = [
            'row' => $row
        ];
        return view('User::admin.role.detail', $data);
    }

    public function permission_matrix()
    {
        $permissions = Permission::all();
        $permissions_group = [
            'other' => []
        ];
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $sCheck = strpos($permission->name, '_');
                if ($sCheck == false) {
                    $permissions_group['other'][] = $permission;
                    continue;
                }
                $grName = substr($permission->name, 0, $sCheck);
                if (!isset($permissions_group[$grName]))
                    $permissions_group[$grName] = [];
                $permissions_group[$grName][] = $permission;
            }
        }
        if (empty($permissions_group['other'])) {
            unset($permissions_group['other']);
        }
        $roles = Role::all();
        $selectedIds = [];
        if (!empty($roles)) {
            foreach ($roles as $role) {
                $selectedIds[$role->id] = [];
                $selected = $role->permissions;
                if (!empty($selected)) {
                    foreach ($selected as $permission) {
                        $selectedIds[$role->id][] = $permission->id;
                    }
                }
            }
        }
        $data = [
            'permissions'       => $permissions,
            'roles'             => $roles,
            'permissions_group' => $permissions_group,
            'selectedIds'       => $selectedIds,
            'role'              => $role
        ];
        return view('User::admin.role.permission_matrix', $data);
    }

    public function save_permissions(Request $request)
    {
        $matrix = $request->input('matrix');
        $matrix = is_array($matrix) ? $matrix : [];
        if (!empty($matrix)) {
            foreach ($matrix as $role_id => $permissionIds) {
                $role = Role::find($role_id);
                if (!empty($role)) {
                    $permissions = Permission::find($permissionIds);
                    $role->syncPermissions($permissions);
                }
            }
        }
        return redirect()->back()->with('success', __('Permission Matrix updated'));
    }
}