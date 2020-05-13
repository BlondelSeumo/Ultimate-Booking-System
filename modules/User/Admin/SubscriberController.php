<?php
namespace Modules\User\Admin;

use App\User;
use function Clue\StreamFilter\fun;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\User\Exports\SubscriberExport;
use Modules\User\Models\Subscriber;

class SubscriberController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('newsletter_manage');
        $listCategory = new Subscriber;
        if (!empty($search = $request->query('s'))) {
            $listCategory = $listCategory->where(function ($query) use ($request) {

                $query->where('first_name', 'LIKE', '%' . $request->s . '%');
                $query->orWhere('last_name', 'LIKE', '%' . $request->s . '%');
                $query->orWhere('email', 'LIKE', '%' . $request->s . '%');
            });
        }
        $listCategory = $listCategory->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $listCategory->paginate(20),
            'row'         => new Subscriber(),
            'breadcrumbs' => [
                [
                    'name' => __('User'),
                    'url'  => 'admin/module/user'
                ],
                [
                    'name'  => __('Subscribers'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('User::newsletter.subscriber.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('newsletter_manage');
        $row = Subscriber::find($id);
        if (empty($row)) {
            return redirect()->back();
        }
        $data = [
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('User'),
                    'url'  => 'admin/module/user'
                ],
                [
                    'name' => __('Subscribers'),
                    'url'  => 'admin/module/user/subscriber'
                ],
                [
                    'name'  => __('Edit: :email', ['email' => $row->email]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('User::newsletter.subscriber.detail', $data);
    }

    public function store(Request $request)
    {
        $this->checkPermission('newsletter_manage');
        $request->validate([
            'email'      => 'required|email|max:255',
            'first_name' => 'max:255',
            'last_name'  => 'max:255',
        ]);
        if ($request->input('id')) {
            $row = Subscriber::find($request->input('id'));
        } else {
            $row = new Subscriber();
        }
        $check = Subscriber::where('email', $request->input('email'))->first();
        if ($check and $check->id != $request->input('id')) {
            return redirect()->back()->with('error', __('Email exists'));
        }
        $row->fill($request->input());
        if ($row->save()) {
            return redirect()->back()->with('success', __('Subscriber updated'));
        }
    }

    public function editBulk(Request $request)
    {
        $this->checkPermission("newsletter_manage");
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = Subscriber::where("id", $id);
                    $query->first()->delete();
                }
                break;
            default:
                foreach ($ids as $id) {
                    $query = Subscriber::where("id", $id);
                    $query->update(['status' => $action]);
                }
                break;
        }
        return redirect()->back()->with('success', __('Updated successfully!'));
    }

    public function export()
    {
        return (new SubscriberExport())->download('subscribers-' . date('M-d-Y') . '.xlsx');
    }
}