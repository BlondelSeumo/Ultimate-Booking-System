<?php
namespace Modules\Tour\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Models\Attributes;
use Modules\Tour\Models\TourTerm;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Location\Models\Location;

class TourController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/tour');
    }

    public function index(Request $request)
    {
        $this->checkPermission('tour_view');
        $query = Tour::query() ;
        $query->orderBy('id', 'desc');
        if (!empty($tour_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $tour_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if ($this->hasPermission('tour_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with(['getAuthor','category_tour'])->paginate(20),
            'tour_categories'    => TourCategory::where('status', 'publish')->get()->toTree(),
            'tour_manage_others' => $this->hasPermission('tour_manage_others'),
            'breadcrumbs'        => [
                [
                    'name' => __('Tours'),
                    'url'  => 'admin/module/tour'
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('tour_create');
        if (!empty($request->input())) {
            $row = new Tour($request->input());
            if ($row->save()) {
                $this->saveTerms($row, $request);
                $row->saveMeta($request);
                $row->saveSEO($request);
                return redirect('admin/module/tour')->with('success', __('Tour created!'));
            }
        } else {
            $row = new Tour();
            $row->fill([
                'status' => 'publish'
            ]);
        }
        $data = [
            'row'           => $row,
            'attributes'    => Attributes::where('service', 'tour')->get(),
            'tour_category' => TourCategory::where('status', 'publish')->get()->toTree(),
            'tour_location' => Location::where('status', 'publish')->get()->toTree(),
            'breadcrumbs'   => [
                [
                    'name' => __('Tours'),
                    'url'  => 'admin/module/tour'
                ],
                [
                    'name'  => __('Add Tour'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('tour_update');
        $row = Tour::find($id);
        if (empty($row)) {
            return redirect('admin/module/tour');
        }
        if (!$this->hasPermission('tour_manage_others')) {
            if ($row->create_user != Auth::id()) {
                return redirect('admin/module/tour');
            }
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {
                $this->saveTerms($row, $request);
                $row->saveMeta($request);
                $row->saveSEO($request);
                return redirect('admin/module/tour/edit/'.$id)->with('success', __('Tour updated!'));
            }
        }
        $data = [
            'row'            => $row,
            "selected_terms" => $row->tour_term->pluck('term_id'),
            'attributes'     => Attributes::where('service', 'tour')->get(),
            'tour_category' => TourCategory::where('status', 'publish')->get()->toTree(),
            'tour_location' => Location::where('status', 'publish')->get()->toTree(),
            'breadcrumbs'    => [
                [
                    'name' => __('Tours'),
                    'url'  => 'admin/module/tour'
                ],
                [
                    'name'  => __('Edit Tour'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Tour::admin.detail', $data);
    }

    public function saveTerms($row, $request)
    {
        $this->checkPermission('tour_manage_attributes');
        if (empty($request->input('terms'))) {
            TourTerm::where('tour_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                TourTerm::firstOrCreate([
                    'term_id' => $term_id,
                    'tour_id' => $row->id
                ]);
            }
            TourTerm::where('tour_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function bulkEdit(Request $request)
    {

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
                $query = Tour::where("id", $id);
                if (!$this->hasPermission('tour_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('tour_delete');
                }
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = Tour::where("id", $id);
                if (!$this->hasPermission('tour_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('tour_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}