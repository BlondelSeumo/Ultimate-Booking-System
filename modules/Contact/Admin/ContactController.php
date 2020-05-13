<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/5/2019
 * Time: 11:31 AM
 */
namespace Modules\Contact\Admin;

use function Clue\StreamFilter\fun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Contact\Models\Contact;

class ContactController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/report');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('contact_manage');

        $s = $request->query('s');
        $datapage = New Contact;
        if ($s) {
            $datapage->where(function ($query) use ($s){
                $query->where('name', 'LIKE', '%' . $s . '%')
                    ->orWhere('email','LIKE', '%' . $s . '%')
                    ->orWhere('message','LIKE', '%' . $s . '%')
                ;
            });
        }
        $data = [
            'rows'        => $datapage->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Contact Submissions'),
                    'url'  => 'admin/module/contact'
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Contact::admin.index', $data);
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Contact::select('id', 'title as text');
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('contact_manage');

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('No Action is selected!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                Contact::where("id", $id)->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = Contact::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}