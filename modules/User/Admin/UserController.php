<?php
namespace Modules\User\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\AdminController;
use Spatie\Permission\Models\Role;

class UserController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/user');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('user_view');
        $username = $request->query('s');
        $listUser = User::query();
        if (!empty($username)) {
             $listUser->where(function($query) use($username){
                 $query->where('first_name', 'LIKE', '%' . $username . '%');
                 $query->orWhere('id',  $username);
                 $query->orWhere('phone',  $username);
                 $query->orWhere('email', 'LIKE', '%' . $username . '%');
                 $query->orWhere('last_name', 'LIKE', '%' . $username . '%');
             });
        }

        if($request->query('role')){
            $listUser->role($request->query('role'));
        }
        $data = [
            'rows' => $listUser->paginate(20),
            'roles' => Role::all()
        ];
        return view('User::admin.index', $data);
    }

    public function create(Request $request)
    {

        $row = new \Modules\User\Models\User();

        $data = [
            'row' => $row,
            'roles' => Role::all()
        ];
        return view('User::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {

        $row = User::find($id);
        if (empty($row)) {
            return redirect('admin/module/user');
        }
        if ($row->id != Auth::user()->id and !Auth::user()->hasPermissionTo('user_update')) {
            abort(403);
        }
        $data = [
            'row'   => $row,
            'roles' => Role::all()
        ];
        return view('User::admin.detail', $data);
    }

    public function password(Request $request,$id){

        $row = User::find($id);

        $data  = [
            'row'=>$row,
            'currentUser'=>Auth::user()
        ];


        if (empty($row)) {
            return redirect('admin/module/user');
        }
        if ($row->id != Auth::user()->id and !Auth::user()->hasPermissionTo('user_update')) {
            abort(403);
        }

        return view('User::admin.password',$data);
    }

    public function changepass(Request $request, $id)
    {
        $rules = [];
        $urow = User::find($id);
        if ($urow->id != Auth::user()->id and !Auth::user()->hasPermissionTo('user_update')) {
            abort(403);
        }
        $request->validate([
            'password'              => 'required|min:6|max:255',
            'password_confirmation' => 'required',
        ]);
        $password_confirmation = $request->input('password_confirmation');
        $password = $request->input('password');
        if ($password != $password_confirmation) {
            return redirect()->back()->with("error", __("Your New password does not matches. Please type again!"));
        }
        if ($urow->id != Auth::user()->id and !Auth::user()->hasPermissionTo('user_update')) {
            if ($password) {
                if ($urow->id != Auth::user()->id) {
                    $rules['old_password'] = 'required';
                }
                $rules['password'] = 'required|string|min:6|confirmed';
            }
            $this->validate($request, $rules);
            if ($password) {
                if (!(Hash::check($request->input('old_password'), $urow->password))) {
                    // The Old passwords matches
                    return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
                }
            }
        }
        $urow->password = bcrypt($password);
        if ($urow->save()) {

            if ($request->input('role_id') and $role = Role::findById($request->input('role_id'))) {
                $urow->assignRole($role);
            }
            return redirect()->back()->with('success', __('Password updated!'));
        }
    }

    public function store(Request $request, $id)
    {

        if($id and $id>0){
            $this->checkPermission('user_update');
            $row = User::find($id);
            if(empty($row)){
                abort(404);
            }
            if ($row->id != Auth::user()->id and !Auth::user()->hasPermissionTo('user_update')) {
                abort(403);
            }

            $request->validate([
                'first_name'              => 'required|max:255',
                'last_name'              => 'required|max:255',
                'status'              => 'required|max:50',
                'role_id'              => 'required|max:11'
            ]);

        }else{
            $this->checkPermission('user_create');

            $check = Validator::make($request->input(),[
                'first_name'              => 'required|max:255',
                'last_name'              => 'required|max:255',
                'status'              => 'required|max:50',
                'role_id'              => 'required|max:11',
                'email'              => 'required|email|max:255|unique:users',
            ]);

            if(!$check->validated()){
                return back()->withInput($request->input());
            }

            $row = new User();
            $row->email = $request->input('email');
        }

        $row->name = $request->input('name');
        $row->first_name = $request->input('first_name');
        $row->last_name = $request->input('last_name');
        $row->phone = $request->input('phone');
        $row->birthday = $request->input('birthday');
        $row->address = $request->input('address');
        $row->address2 = $request->input('address2');
        $row->bio = clean($request->input('bio'));
        $row->status = $request->input('status');
        $row->avatar_id = $request->input('avatar_id');
        if ($row->save()) {

            if ($request->input('role_id') and $role = Role::findById($request->input('role_id'))) {
                $row->assignRole($role);
            }
            return redirect('admin/module/user')->with('success', ($id and $id>0) ? __('User updated'):__("User created"));
        }
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = User::select('*');
        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('first_name', 'like', '%' . $q . '%')->orWhere('last_name', 'like', '%' . $q . '%')->orWhere('email', 'like', '%' . $q . '%')->orWhere('id', $q)->orWhere('phone', 'like', '%' . $q . '%');
            });
        }
        $res = $query->orderBy('id', 'desc')->orderBy('first_name', 'asc')->limit(20)->get();
        $data = [];
        if (!empty($res)) {
            foreach ($res as $item) {
                $data[] = [
                    'id'   => $item->id,
                    'text' => $item->first_name ? $item->first_name . ' (#' . $item->id . ')' : $item->email . ' (#' . $item->id . ')',
                ];
            }
        }
        return response()->json([
            'results' => $data
        ]);
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids))
            return redirect()->back()->with('error', __('Select at leas 1 item!'));
        if (empty($action))
            return redirect()->back()->with('error', __('Select an Action!'));
        if ($action == 'delete') {
            foreach ($ids as $id) {
                User::where("id", $id)->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                User::where("id", $id)->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated successfully!'));
    }
}
